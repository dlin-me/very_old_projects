<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title><?php if(Page::$data['title']) {echo Page::$data['title']; }else{ echo 'UniSale.com.au - Admin'; } ?></title>
<link href="./theme/default.css" rel="stylesheet" type="text/css" />
</head>
<body leftmargin="0" rightmargin="0" topmargin="0" bottommargin="0" bgcolor="#ffffff">
<table cellpadding="0" cellspacing="0" height="100%" width="100%">
	<tbody>
	<tr>
		<td align="center"><table cellpadding="0" cellspacing="0" height="100%">
				<tbody>
				<tr>
					<td background="./theme/IMG_SKIN_LEFT_SHADOW.gif" height="100%" valign="bottom" width="31"><img src="./theme/IMG_SKIN_LEFT_SHADOW.gif"> </td>
					<td valign="top"><table cellpadding="0" cellspacing="0" height="100%" width="100%">
							<tbody>
							<tr>
								<td align="left" background="./theme/IMG_HEADER_NONAME.gif" height="60"><img src="./theme/IMG_HEADER.gif"></td>
							</tr>
							<tr>
								<td background="./theme/IMG_INNER_BG.gif" height="100%" valign="top"><table cellpadding="0" cellspacing="0" height="100%" width="100%">
										<tbody>
										<tr>
											<td height="1" valign="top" width="586"><table background="./theme/IMG_SKIN_NAV_BG.gif" cellpadding="0" cellspacing="0" width="100%">
													<tbody>
														<tr>
															<td><a href="<?php echo WEB_DIR.'/index.php'; ?>"><img src="./theme/IMG_MENU_HOME<?php if(Page::$data['tag']=='home') echo '_OVER'; ?>.jpg" onMouseOver="this.src='./theme/IMG_MENU_HOME_OVER.jpg'" onMouseOut="this.src='./theme/IMG_MENU_HOME.jpg'" /></a></td>
															<td><a href="<?php echo WEB_DIR.'/listing.php'; ?>"><img src="./theme/IMG_MENU_LISTING<?php if(Page::$data['tag']=='listing') echo '_OVER'; ?>.jpg" onMouseOver="this.src='./theme/IMG_MENU_LISTING_OVER.jpg'" onMouseOut="this.src='./theme/IMG_MENU_LISTING<?php if(Page::$data['tag']=='listing') echo '_OVER'; ?>.jpg'"/></a></td>
															<td><a href="<?php echo WEB_DIR.'/category.php'; ?>"><img src="./theme/IMG_MENU_CAT<?php if(Page::$data['tag']=='category') echo '_OVER'; ?>.jpg" onMouseOver="this.src='./theme/IMG_MENU_CAT_OVER.jpg'" onMouseOut="this.src='./theme/IMG_MENU_CAT<?php if(Page::$data['tag']=='category') echo '_OVER'; ?>.jpg'"/></a></td>
															<td><a href="<?php echo WEB_DIR.'/member.php'; ?>"><img src="./theme/IMG_MENU_MEM<?php if(Page::$data['tag']=='member') echo '_OVER'; ?>.jpg" onMouseOver="this.src='./theme/IMG_MENU_MEM_OVER.jpg'" onMouseOut="this.src='./theme/IMG_MENU_MEM<?php if(Page::$data['tag']=='member') echo '_OVER'; ?>.jpg'"/></a></td>
															<td><a href="<?php echo WEB_DIR.'/message.php'; ?>"><img src="./theme/IMG_MENU_MSG<?php if(Page::$data['tag']=='home') echo '_OVER'; ?>.jpg" onMouseOver="this.src='./theme/IMG_MENU_MSG_OVER.jpg'" onMouseOut="this.src='./theme/IMG_MENU_MSG.jpg'"/></a></td>
															<td><a href="<?php echo WEB_DIR.'/request.php'; ?>"><img src="./theme/IMG_MENU_REQUEST<?php if(Page::$data['tag']=='home') echo '_OVER'; ?>.jpg" onMouseOver="this.src='./theme/IMG_MENU_REQUEST_OVER.jpg'" onMouseOut="this.src='./theme/IMG_MENU_REQUEST.jpg'" /></a></td>
															<td align="right" width="100%"><a href="<?php echo WEB_DIR.'/auth.php?_a=logout'; ?>"><img src="./theme/IMG_MENU_LOGOUT.jpg"  onMouseOver="this.src='./theme/IMG_MENU_LOGOUT_OVER.jpg'" onMouseOut="this.src='./theme/IMG_MENU_LOGOUT.jpg'" /></a></td>
														</tr>
													</tbody>
												</table>
												<table cellpadding="0" cellspacing="0" height="100%" width="100%">
													<tbody>
													<tr>
														<td style="padding-bottom: 35px;" height="60%" valign="top">

														<?php

                                                            foreach( Page::$data['COL_LEFT'] as $tpl ){ ;
                                                                include (TPL_ROOT.'/'.$tpl.'.php');

                                                            }
                                                        ?>

														</td>
													</tr>
													</tbody>
												</table></td>
											<td class="white" style="background: rgb(52, 91, 128) none repeat scroll 0%; -moz-background-clip: -moz-initial; -moz-background-origin: -moz-initial; -moz-background-inline-policy: -moz-initial;" align="right" valign="top">

                                               			<?php

                                                            foreach( Page::$data['COL_RIGHT'] as $tpl ){ ;
                                                                include (TPL_ROOT.'/'.$tpl.'.php');

                                                            }
                                                        ?>
											</td>
										</tr>
										</tbody>
									</table></td>
							</tr>
							<tr>
								<td style="padding: 0px 0px 0px 10px; background: rgb(52, 91, 128) url(/IMG_INNER_BG) repeat-y scroll 0%; -moz-background-clip: -moz-initial; -moz-background-origin: -moz-initial; -moz-background-inline-policy: -moz-initial;"><font class="tree">demo_admin</font> ?<a class="tree" href="http://www.directadmin.com:2222/HTM_PASSWD">Change your Password</a> </td>
							</tr>
							<tr>
								<td class="white" style="background: rgb(52, 91, 128) url(/IMG_FOOTER_BAR) no-repeat scroll 0%; padding-bottom: 8px; -moz-background-clip: -moz-initial; -moz-background-origin: -moz-initial; -moz-background-inline-policy: -moz-initial;" align="center" height="50" valign="bottom"><a class="white" href="http://www.directadmin.com/">DirectAdmin</a> Web Control Panel ?2007 JBMC Software </td>
							</tr>
							</tbody>
						</table></td>
					<td background="./theme/IMG_SKIN_RIGHT_SHADOW.gif" width="31"></td>
				</tr>
				</tbody>
			</table></td>
	</tr>
	</tbody>
</table>
</body>
</html>
