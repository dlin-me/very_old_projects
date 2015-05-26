<?php

/**
 * Class Table
 *
 * @version $Id$
 * @copyright 2007
 */

/**
 * Table
 *
 * @package
 * @author Administrator
 * @copyright Copyright (c) 2007
 * @version $Id$
 * @access public
 */
class Table{
    // general basic table info
    public $tblName; //table name
    public $tblIdCol; //table id column name
    public $tblCols; //an array of the column names in this table
    public $tblForeignCols; //an array of foreign cols with the foreign table name as the index

    // used for data manipulation
    public $tblFilters; //filter, this will affected all query to database through this class except the 'query' method. array in format of [col_name]=value
    public $tblCreatedCol; // to identify the  col used to store the time this row is inserted
    public $tblUpdatedCol; // to identify the col storing the time a row is updated
    public $tblRecycledCol; // to identify the col used to store the time a row is recycled

    // used for validation
    public $tblColRequired; //an array holding the column names that are required when inserting or updating into the table
    public $tblColRules; //this are the validation rules for column validation must in formatt of [col_name] = array($type, operant); or [col_name] = array($type, array(operant1, operant2));
    public $tblColErrors; //this are the validation error message for column validation

    // used for sql buffering and tracing
    private $queryStart = 0; //this is the time query starts
    public static $trace = array(); //this is the array holding the query records
    private static $sqlBuffer = array(); //this array holds query results to avoid repeated query



	public function __construct(){
		try{
            $this->dbh = new PDO(DB_DSN, DB_USR, DB_PWD);
        }

        Catch (PDOException $e){
            exit ('Connection failed: ' . $e->getMessage());
        }


	}
    /**
     * Table::getErrors()
     * Pares the $data array and return the error if there is any
     *
     * @param mixed $data
     * @return
     */
    public function getErrors($data){
        $err = array();
        // first validate $data input
        if(!is_array($data) || empty($data)){
            $err['ALL'] = 'Please enter some data';
        }
        // second, validate the required rule
        if(is_array($this->tblColRequired)){
            foreach($this->tblColRequired as $col){
                if(!isset($data[$col]) || empty($data[$col])){
                    $colName = isset($this->tblCols[$col])? $this->tblCols[$col]:$col ;
                    $err[$col] = '"' . $colName . '" is required';
                }
            }
        }
        // next, validate the general rule
        if(is_array($this->tblColRules)){
            foreach ($data as $col => $v){
                if(isset($this->tblColRules[$col]) && !empty($v)){
                    foreach($this->tblColRules[$col] as $errMsg => $rule){
                        $validator = new Validator($rule[0], $rule[1]);
                        if(!$validator->validate($v)){
                            $colName = isset($this->tblCols[$col])? $this->tblCols[$col]:$col ;
                            $err[$col] = '"' . $colName . '" ' . $errMsg;
                        }
                    }
                }
            }
        }
        return $err;
    }

    /**
     * Table::markStartTime()
     * Used internally to mark the start time of a database query
     *
     * @return void
     */
    private function markStartTime(){
        $this->queryStart = microtime(true);
    }

    /**
     * Table::markEndTime()
     * used internally to mark the end time of a database query
     *
     * @param mixed $sql
     * @param mixed $stmt
     * @return
     */
    private function markEndTime($sql, $stmt = null){
        if(!is_null($stmt)){
            $e = $stmt->errorInfo();
            if(isset($e[2])){
                self::$trace[$sql] = $e[2];
            }else{
                self::$trace[$sql] = microtime(true) - $this->queryStart;
            }
        }else{
            self::$trace[$sql] = microtime(true) - $this->queryStart;
        }
        $this->queryStart = 0;
    }

    /**
     * Table::getFilterSql()
     *
     * @param string $sap
     * @param mixed $prefix_sap
     * @return String the sql filtering statement
     */
    private function getFilterSql($sap = ' AND ', $prefix_sap = true, $include_parenthesis = true){
        if(count($this->tblFilters) > 0){
            $f = array();
            foreach($this->tblFilters as $col => $value){
                $f[] = $this->tblName . '.' . $col . '=' . $this->dbh->quote($value);
            }
            return ($prefix_sap ?$sap:'') . ($include_parenthesis?'(':'') . implode($sap, $f) . ($include_parenthesis?')':'');
        }else{
            return '';
        }
    }

    /**
     * DATA RETRIEVAL
     */
    /**
     * Table::getRowById()
     *
     * @param mixed $id
     * @return an array of row data identified by the table id
     */
    public function getRowById($id){
        $sql = 'SELECT * FROM ' . $this->tblName . ' WHERE ' . $this->tblIdCol . ' =' . intval($id) . $this->getFilterSql();
        if(!isset(self::$sqlBuffer['getRowById' . $sql])){
            $this->markStartTime();
            $stmt = $this->dbh->prepare($sql);
            $stmt->execute();
            $res = $stmt->fetch(PDO::FETCH_ASSOC);
            $stmt->closeCursor();
            $this->markEndTime($sql, $stmt);
            self::$sqlBuffer['getRowById' . $sql] = $res;
        }
        return self::$sqlBuffer['getRowById' . $sql];
    }

    /**
     * Table::getExpRowById()
     *
     * @param mixed $id
     * @return
     */
    public function getExpRowById($id){
        $fromStr = $this->tblName;
        $whereStr = $this->tblName . '.' . $this->tblIdCol . '= ' . intval($id);
        foreach($this->tblForeignCols as $lCol => $fDetails){ // $fDeatils = array('fTable', 'fCol');
            $fromStr .= ', ' . $fDetails[0];
            $whereStr .= ' AND ' . $this->tblName . '.' . $lCol . '=' . $fDetails[0] . '.' . $fDetails[1];
        }
        $sql = 'SELECT * FROM ' . $fromStr . '  WHERE ' . $whereStr . $this->getFilterSql();
        if(!isset(self::$sqlBuffer['getExpRowById' . $sql])){
            if(count($this->tblForeignCols) > 0){
                $this->markStartTime();
                $stmt = $this->dbh->prepare($sql);
                $stmt->execute();
                $res = $stmt->fetch(PDO::FETCH_ASSOC);
                $stmt->closeCursor();
                $this->markEndTime($sql, $stmt);
                self::$sqlBuffer['getExpRowById' . $sql] = $res;
            }else{
                self::$sqlBuffer['getExpRowById' . $sql] = $this->getRowById($id);
            }
        }
        return self::$sqlBuffer['getExpRowById' . $sql];
    }

    /**
     * Table::getRowsByIds()
     *
     * @param mixed $ids
     * @return
     */
    public function getRowsByIds($ids){
        $idstr = implode(', ', $ids);
        $fromStr = $this->tblName;
        $whereStr = $this->tblName . '.' . $this->tblIdCol . ' in (' . $idstr . ')';
        foreach($this->tblForeignCols as $lCol => $fDetails){
            $fromStr .= ', ' . $fDetails[0];
            $whereStr .= ' AND ' . $this->tblName . '.' . $lCol . '=' . $fDetails[0] . '.' . $fDetails[1];
        }
        $sql = 'SELECT * FROM ' . $fromStr . '  WHERE ' . $whereStr . $this->getFilterSql();
        if(!isset(self::$sqlBuffer['getRowsByIds' . $sql])){
            if(count($ids) > 0){
                $this->markStartTime();
                $stmt = $this->dbh->prepare($sql);
                $stmt->execute();
                $res = $stmt->fetch(PDO::FETCH_ASSOC);
                $stmt->closeCursor();
                $this->markEndTime($sql, $stmt);
                self::$sqlBuffer['getRowsByIds' . $sql] = $res;
            }elseif(count($ids) == 1){
                self::$sqlBuffer['getRowsByIds' . $sql] = $this->getRowById($id[0]);
            }
        }
        return self::$sqlBuffer['getRowsByIds' . $sql];
    }

    /**
     * Table::getRows()
     *
     * @param array $cols
     * @param array $order
     * @param integer $offset
     * @param integer $length
     * @return
     */
    public function getRows($cols = array(), $order = array(), $offset = 0, $length = 10000){
        $whereStr = ' 1=1 ';
        if(!empty($cols)){
            foreach($cols as $c => $value){
                if(is_array($value)){ // this is OR term
                    $temp_where = array();
                    foreach($value as $or_c => $or_value){
                        if($or_value{0} == '%'){
                            $temp_where[] = $this->tblName . '.' . $or_c . " LIKE " . $this->dbh->quote($or_value);
                        }else{
                            $temp_where[] = $this->tblName . '.' . $or_c . "=" . $this->dbh->quote($or_value);
                        }
                    }

                    $temp_where_str = implode (' OR ', $temp_where);
                    $whereStr .= " AND (" . $temp_where_str . ")";
                }elseif($value{0} == '%'){

					$whereStr .= " AND " . $this->tblName . '.' . $c . " LIKE " . $this->dbh->quote($value);

                }elseif(strpos($value, '< ')===0 ){
					$whereStr .= " AND " . $this->tblName . '.'. $c . "<" . $this->dbh->quote(substr($value, 2));

				}elseif(strpos($value, '> ')===0 ){
					$whereStr .= " AND " . $this->tblName . '.'. $c . ">" . $this->dbh->quote(substr($value, 2));

				}elseif(strpos($value, '<= ')===0 ){
					$whereStr .= " AND " . $this->tblName . '.'. $c . "<=" . $this->dbh->quote(substr($value, 3));

				}elseif(strpos($value, '>= ')===0 ){
					$whereStr .= " AND " . $this->tblName . '.'. $c . ">=" . $this->dbh->quote(substr($value, 3));

                }else{
                    $whereStr .= " AND " . $this->tblName . '.'. $c . "=" . $this->dbh->quote($value);
                }
            }
        }

        $orderStr = '';
        if(!empty($order)){
            $orderArray = array();
            foreach($order as $col => $rk){
                $orderArray[] = $this->tblName . '.' .$col . ' ' . $rk;
            }

            $orderStr = ' ORDER BY '.implode(', ', $orderArray);

        }elseif(!empty($this->tblDefaultOrder)){
            $orderArray = array();
            foreach($this->tblDefaultOrder as $col => $rk){
                $orderArray[] = $this->tblName . '.' .$col . ' ' . $rk;
            }

            $orderStr = ' ORDER BY '.implode(', ', $orderArray);

        }

        $sql = 'SELECT * FROM ' . $this->tblName . ' WHERE ' . $whereStr . $this->getFilterSql() . $orderStr . ' LIMIT ' . $offset . ', ' . $length;
        if(!isset(self::$sqlBuffer['getRows' . $sql])){
            $this->markStartTime();
            $stmt = $this->dbh->prepare($sql);
            $stmt->execute();
            $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $stmt->closeCursor();
            $this->markEndTime($sql, $stmt);
            self::$sqlBuffer['getRows' . $sql] = $res;
        }
        return self::$sqlBuffer['getRows' . $sql];
    }

    /**
     * Table::countRows()
     *
     * @param array $cols
     * @param array $order
     * @return
     */
    public function countRows($cols = array()){
        $whereStr = ' 1=1 ';
        if(!empty($cols)){
            foreach($cols as $c => $value){
                if(is_array($value)){ // this is OR term
                    $temp_where = array();
                    foreach($value as $or_c => $or_value){
                        if(strpos($or_value, '%') === 0){
                            $temp_where[] = $this->tblName . '.' . $or_cc . " LIKE " . $this->dbh->quote($or_value);
                        }else{
                            $temp_where[] = $or_c . "=" . $this->dbh->quote($or_value);
                        }
                    }

                    $temp_where_str = implode (' OR ', $temp_where);
                    $whereStr .= " AND (" . $temp_where_str . ")";
                }elseif(strpos($value, '%') === 0){
                    $whereStr .= " AND " . $this->tblName . '.' . $c . " LIKE " . $this->dbh->quote($value);
                }else{
                    $whereStr .= " AND " . $c . "=" . $this->dbh->quote($value);
                }
            }
        }

        $sql = 'SELECT count(*) FROM ' . $this->tblName . ' WHERE ' . $whereStr . $this->getFilterSql() ;
        if(!isset(self::$sqlBuffer['countRows' . $sql])){
            $this->markStartTime();
            $stmt = $this->dbh->prepare($sql);
            $stmt->execute();
            $res = intval($stmt->fetchColumn(0));
            $stmt->closeCursor();
            $this->markEndTime($sql, $stmt);
            self::$sqlBuffer['countRows' . $sql] = $res;
        }

        return self::$sqlBuffer['countRows' . $sql];
    }

    /**
     * Table::getExpRows()
     *
     * @param array $cols
     * @param array $order
     * @param integer $offset
     * @param integer $length
     * @return
     */
    public function getExpRows($cols = array(), $order = array(), $offset = 0, $length = 10000){



        if(!empty($this->tblForeignCols)){
            $fromStr = $this->tblName;
            $whereStr = ' 1=1 ';
            foreach($this->tblForeignCols as $lCol => $fDetails){
                $fromStr .= ', ' . $fDetails[0];
                $whereStr .= ' AND ' . $this->tblName . '.' . $lCol . '=' . $fDetails[0] . '.' . $fDetails[1];
            }

        }else{
            return $this->getRows($cols, $order, $offset, $length);
        }


        if(!empty($cols)){
            foreach($cols as $c => $value){
                if(is_array($value)){ // this is OR term
                    $temp_where = array();
                    foreach($value as $or_c => $or_value){
                        if($or_value{0} == '%'){
                            $temp_where[] = $this->tblName . '.' . $or_c . " LIKE " . $this->dbh->quote($or_value);
                        }else{
                            $temp_where[] = $this->tblName . '.'. $or_c . "=" . $this->dbh->quote($or_value);
                        }
                    }

                    $temp_where_str = implode (' OR ', $temp_where);
                    $whereStr .= " AND (" . $temp_where_str . ")";
                }elseif($value{0} == '%'){
                    $whereStr .= " AND " . $this->tblName . '.' . $c . " LIKE " . $this->dbh->quote($value);
                }else{
                    $whereStr .= " AND " . $this->tblName . '.' . $c . "=" . $this->dbh->quote($value);
                }
            }
        }

        $orderStr = '';
        if(!empty($order)){
            $orderArray = array();
            foreach($order as $col => $rk){
                $orderArray[] = $this->tblName . '.' .$col . ' ' . $rk;
            }

            $orderStr = ' ORDER BY '.implode(', ', $orderArray);

        }elseif(!empty($this->tblDefaultOrder)){
            $orderArray = array();
            foreach($this->tblDefaultOrder as $col => $rk){
                $orderArray[] = $this->tblName . '.' .$col . ' ' . $rk;
            }

            $orderStr = ' ORDER BY '.implode(', ', $orderArray);


        }

        $sql = 'SELECT * FROM ' . $fromStr . ' WHERE ' . $whereStr . $this->getFilterSql() . $orderStr . ' LIMIT ' . $offset . ', ' . $length;

        if(!isset(self::$sqlBuffer['getExpRows' . $sql])){
            $this->markStartTime();
            $stmt = $this->dbh->prepare($sql);
            $stmt->execute();
            $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $stmt->closeCursor();
            $this->markEndTime($sql, $stmt);
            self::$sqlBuffer['getExpRows' . $sql] = $res;
        }
        return self::$sqlBuffer['getExpRows' . $sql];
    }

    /**
     * Table::query()
     * General database query
     *
     * @param mixed $sql
     * @return
     */
    public function query($sql){
        if(!isset(self::$sqlBuffer['query' . $sql])){
            $this->markStartTime();
            $stmt = $this->dbh->query($sql);
            if($stmt){
                $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
                $this->markEndTime($sql, $stmt);
                self::$sqlBuffer['query' . $sql] = $res;
            }else{
                exit('Query to ' . $this->tblName . ' failed.');
            }
        }

        return self::$sqlBuffer['query' . $sql];
    }

    /**
     * DATA MANIPULATION
     */

    /**
     * Table::removeRowById()
     *
     * @param mixed $id
     * @return
     */
    public function removeRowById($id){
        $this->markStartTime();
        $sql = 'DELETE FROM ' . $this->tblName . ' WHERE ' . $this->tblIdCol . '=' . intval($id) . $this->getFilterSql();;
        $res = $this->dbh->exec($sql);
        $this->markEndTime($sql, $stmt);
        return $res;
    }

    /**
     * Table::updateRow()
     *
     * @param mixed $id
     * @param mixed $data
     * @return
     */
    public function updateRow($id, array $data){
        // first test if the $id is valid
        if($id <= 0 || empty($data)){
            return false;
        }

		$data[$this->tblUpdatedCol] = $_SERVER['REQUEST_TIME'];
        $good_data = array();
        // filter the $data
        foreach($data as $col => $value){
            if(array_key_exists($col, $this->tblCols)){

                $good_data[] = $col . '=' . $this->dbh->quote($value);
            }
        }

        if(empty($good_data)){
            return false;
        }

        $setStr = implode(', ', $good_data);
        $this->markStartTime();
        $sql = 'UPDATE ' . $this->tblName . ' SET ' . $setStr . ' WHERE ' . $this->tblIdCol . '=' . intval($id) . $this->getFilterSql();
        $res = $this->dbh->exec($sql);
        $this->markEndTime($sql);
        return $res;
    }

    /**
     * Table::createRow()
     *
     * @param mixed $data
     * @return
     */
    public function createRow(array $data){
        unset($data[$this->tblIdCol]);
        // first test if the $id is valie
        if(empty($data)){
            return false;
        }

		$data[$this->tblCreatedCol] = $_SERVER['REQUEST_TIME'];
		$data[$this->tblUpdatedCol] = $_SERVER['REQUEST_TIME'];

		$good_data = array();
        // filter the $data
        foreach($data as $col => $value){
            if(array_key_exists($col, $this->tblCols)){
                $good_data[] = $col . '=' . $this->dbh->quote($value);
            }
        }

        if(empty($good_data)){
            return false;
        }



        $setStr = implode(', ', $good_data);
        $this->markStartTime();
        $sql = 'INSERT INTO ' . $this->tblName . ' SET ' . $setStr . $this->getFilterSql(', ', true, false);
        $res = $this->dbh->exec($sql);
        $this->markEndTime($sql);
        if($res > 0){
            return $this->dbh->lastInsertId(); //might not work
        }else{
            return 0;
        }
    }

    /**
     * Table::recycleRow()
     *
     * @param mixed $id
     * @return
     */
    public function recycleRow($id){
    	$data[$this->tblRecycledCol] = $_SERVER['REQUEST_TIME'];
        return $this->updateRow($id, $data);
    }

    /**
     * Table::restoreRow()
     *
     * @param mixed $id
     * @return
     */
    public function restoreRow($id){
        $data = array($this->tblRecycledCol => 0);
        return $this->updateRow($id, $data);
    }

    /**
     * Table::duplicateRowById()
     *
     * @param mixed $id
     * @return
     */
    public function duplicateRowById($id){
        $data = $this->getRowById($id);
        if(!empty($data)){
            // unset the id col
            unset($data[$this->tblIdCol]);
            return $this->createRow($data);
        }else{
            return false;
        }
    }

    /**
     * Table::getRowsSubsetInfo()
     *
     * @param mixed $criteria
     * @param mixed $order
     * @param mixed $pagePointer
     * @param integer $pageSize
     * @param integer $scrollSize
     * @return
     */
    public function getRowsSubsetInfo($criteria=array(), $order=array(), $pagePointer=1, $pageSize = 20, $scrollSize = 10){

        $count = $this->countRows($criteria);
        $info = self::getPaginationInfo($count, $pagePointer, $pageSize, $scrollSize);
        $rows = $this->getRows($criteria, $order, $info['itemStart']-1, $pageSize);
        return array('rows' => $rows, 'info' => $info);
    }

    /**
     * Table::getExpRowsSubsetInfo()
     *
     * @param mixed $criteria
     * @param mixed $order
     * @param mixed $pagePointer
     * @param integer $pageSize
     * @param integer $scrollSize
     * @return
     */

    public function getExpRowsSubsetInfo($criteria=array(), $order=array(), $pagePointer=1, $pageSize = 20, $scrollSize = 10){

        $count = $this->countRows($criteria);
        $info = self::getPaginationInfo($count, $pagePointer, $pageSize, $scrollSize);
        $rows = $this->getExpRows($criteria, $order, $info['itemStart']-1, $pageSize);
        return array('rows' => $rows, 'info' => $info);
    }

    /**
     * Table::getPaginationInfo()
     *
     * @param mixed $itemTotal
     * @param mixed $pagePointer
     * @param integer $pageSize
     * @param integer $scrollSize
     * @return
     */
    private static function getPaginationInfo($itemTotal, $pagePointer, $pageSize = 20, $scrollSize = 10){
        // getting page total
        $pageTotal = ceil($itemTotal / $pageSize);
        // validate the $pagePointer, if $pagePointer is not valid, set it to the first page 1
        if($pagePointer > $pageTotal || $pagePointer < 1){
            $pagePointer = 1;
        }
        // gettting the scrollPointer
        $scrollPointer = ceil($pageTotal / $scrollSize);
        // getting the pageStart
        $pageStart = ($scrollPointer-1) * $scrollSize + 1;
        $itemStart = ($pagePointer-1) * $pageSize + 1;
        $pageEnd = min($pageStart + $scrollSize-1, $pageTotal);
        $itemEnd = min($itemStart + $pageSize-1, $itemTotal);
        $return = array();
        $return['pagePointer'] = $pagePointer;
        $return['pageTotal'] = $pageTotal;
        $return['pageSize'] = $pageSize;
        $return['pageStart'] = $pageStart;
        $return['pageEnd'] = $pageEnd;
        $return['itemTotal'] = $itemTotal;
        $return['itemStart'] = $itemStart;
        $return['itemEnd'] = $itemEnd;
        return $return;
    }
}

?>