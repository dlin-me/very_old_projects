<input name="action" value="multiple" type="hidden">
																<input value="" name="button" type="hidden">
																<input value="no" name="overwrite" type="hidden">
																<input value="/" name="path" type="hidden">
																<table class="list" cellpadding="3" cellspacing="1">
																	<form name="tableform" action="/CMD_FILE_MANAGER/" method="post">
																	</form>
																	<tbody>
																		<tr>
																			<td colspan="9" align="right"><a class="toptext" href="http://www.directadmin.com:2222/CMD_FILE_MANAGER?view=advanced">Advanced Search</a></td>
																		</tr>
																		<tr>
																			<td class="listtitle"><b><a class="listtitle" href="http://www.directadmin.com:2222/CMD_FILE_MANAGER?sort1=-1">Type</a></b></td>
																			<td class="listtitle"><a class="listtitle" href="http://www.directadmin.com:2222/CMD_FILE_MANAGER?sort1=2">Name</a></td>
																			<td class="listtitle"><a class="listtitle" href="http://www.directadmin.com:2222/CMD_FILE_MANAGER?sort1=3">Size</a></td>
																			<td class="listtitle"><a class="listtitle" href="http://www.directadmin.com:2222/CMD_FILE_MANAGER?sort1=4">Perm.</a></td>
																			<td class="listtitle"><a class="listtitle" href="http://www.directadmin.com:2222/CMD_FILE_MANAGER?sort1=5">Action</a></td>
																			<td class="listtitle"><a class="listtitle" href="http://www.directadmin.com:2222/CMD_FILE_MANAGER?sort1=6">Date</a></td>
																			<td class="listtitle"><a class="listtitle" href="http://www.directadmin.com:2222/CMD_FILE_MANAGER?sort1=7">UID</a></td>
																			<td class="listtitle"><a class="listtitle" href="http://www.directadmin.com:2222/CMD_FILE_MANAGER?sort1=8">GID</a></td>
																			<td class="listtitle" align="center"><a class="listtitle" href="javascript:selectAll('select');">Select</a></td>
																		</tr>
																		<tr>
																			<td class="list"><a href="http://www.directadmin.com:2222/CMD_FILE_MANAGER/images"><img alt="Directory" src="./theme/IMG_FOLDER.gif" border="0"></a></td>
																			<td class="list"><a href="http://www.directadmin.com:2222/CMD_FILE_MANAGER/images">images</a></td>
																			<td class="list"><a href="http://www.directadmin.com:2222/4096"></a>4.00k</td>
																			<td class="list">755</td>
																			<td class="list"><a href="http://www.directadmin.com:2222/CMD_FILE_MANAGER/images?action=protect">Protect</a><br>
																				<a href="http://www.directadmin.com:2222/CMD_FILE_MANAGER/images?action=rename">Rename</a> | <a href="http://www.directadmin.com:2222/CMD_FILE_MANAGER/images?action=copy">Copy</a></td>
																			<td class="list"><a href="http://www.directadmin.com:2222/1048546933"></a>Mar 24 14:41 2003</td>
																			<td class="list">demo_user</td>
																			<td class="list">demo_user</td>
																			<td class="list" align="center"><input name="select0" value="/images" type="checkbox"></td>
																		</tr>
																		<tr title="Size: 4.00 KB
Disk Usage: 4.00 KB
Last Accessed: Tue Sep 11 07:35:12 2007
Last Modified: Tue Sep 11 07:35:12 2007
Last Changed: Tue Sep 11 07:35:12 2007">
																			<td class="list2"><a href="http://www.directadmin.com:2222/CMD_FILE_MANAGER/index.html"><img alt="File" src="./theme/IMG_FILE.gif" border="0"></a></td>
																			<td class="list2"><a href="http://www.directadmin.com:2222/CMD_FILE_MANAGER/index.html">index.html</a></td>
																			<td class="list2"><a href="http://www.directadmin.com:2222/4096"></a>4.00k</td>
																			<td class="list2">755</td>
																			<td class="list2"><a href="http://www.directadmin.com:2222/CMD_FILE_MANAGER/index.html?action=edit">Edit</a><br>
																				<a href="http://www.directadmin.com:2222/CMD_FILE_MANAGER/index.html?action=rename">Rename</a> | <a href="http://www.directadmin.com:2222/CMD_FILE_MANAGER/index.html?action=copy">Copy</a></td>
																			<td class="list2"><a href="http://www.directadmin.com:2222/1048546933"></a>Mar 24 14:41 2003</td>
																			<td class="list2">demo_user</td>
																			<td class="list2">demo_user</td>
																			<td class="list2" align="center"><input name="select1" value="/index.html" type="checkbox"></td>
																		</tr>
																		<tr>
																			<td class="listtitle" colspan="9" align="right">With Selected &nbsp;&nbsp;
																				<input name="permission" value="set Permission" type="submit">
																				<input name="chmod" size="3" value="755" maxlength="3" onfocus="document.tableform.button.value = 'permission'; this.select();" type="text">
&nbsp;&nbsp;or&nbsp;&nbsp;
																				<input name="add" value="Add to Clipboard" type="submit">
&nbsp;&nbsp;or&nbsp;&nbsp;
																				<input value="Delete" onclick="if (confirm('Are you sure you want to delete these files?')){document.tableform.button.value = 'delete';document.tableform.submit();	}" type="button">
																				<br>
																				<hr>
																				<a class="listtitle" href="http://www.directadmin.com:2222/CMD_FILE_MANAGER/.clipboard.txt?action=edit">View Clipboard</a>
																				<input name="copy" value="Copy Clipboard Files here" onclick="if (confirm('Do you want to overwrite any existing files?')) document.tableform.overwrite.value = 'yes';" type="submit">
																				<input name="move" value="Move Clipboard Files here" onclick="if (confirm('Do you want to overwrite any existing files?')) document.tableform.overwrite.value = 'yes';" type="submit">
																				<input name="empty" value="Empty Clipboard" type="submit"></td>
																		</tr>
																	</tbody>
																</table>
																To copy/move files with the clipboard, add the source files to the clipboard with "Add to Clipboard", go to the directory where you wish to copy/move the files, then click "Copy Clipboard Files here" or "Move Clipboard Files here" <br>
																<input name="action" value="folder" type="hidden">
																<input value="/" name="path" type="hidden">
																<input name="action" value="file" type="hidden">
																<input value="/" name="path" type="hidden">
																<input name="action" value="compress" type="hidden">
																<input value="/" name="path" type="hidden">
																<table class="list" cellpadding="3" cellspacing="1">
																	<tbody>
																		<tr>
																			<td class="listtitle" colspan="4">Filesystem Tools</td>
																		</tr>
																		<tr>
																			<form name="folderform" action="/CMD_FILE_MANAGER" method="post">
																			</form>
																			<td class="list">Create New Folder</td>
																			<td class="list"><input name="name" size="15" type="text">
																				<input value="Create" type="submit"></td>
																			<form name="fileform" action="/CMD_FILE_MANAGER" method="post">
																			</form>
																			<td class="list">Create New File</td>
																			<td class="list"><input name="name" size="15" type="text">
																				<input name="file" value="Create" type="submit">
																				<input name="template" value="yes" type="checkbox">
																				<font style="font-size: 6pt;">Html template</font></td>
																		</tr>
																		<tr>
																			<td class="list" colspan="4" align="center"><input value="Upload files to current directory" onclick="location.href='/HTM_FILE_UPLOAD?path=/'" type="button">
																				( / )</td>
																		</tr>
																		<tr>
																			<form action="/CMD_FILE_MANAGER" method="post">
																			</form>
																			<td class="list" colspan="4" align="center">Compress clipboard files to //
																				<input size="8" name="file" type="text">
																				.tar.gz
																				<input value="Create" type="submit"></td>
																		</tr>
																	</tbody>
																</table>