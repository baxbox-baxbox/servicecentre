<meta http-equiv="Content-Type" content="text/html; charset=windows-1251">
			<div id="menu" >
				<ul>



	                    <?

						if ($Mode=="��������")
						{
						?>
                        <li><a href="service.php">������</a></li>
                        <li><a href="reqmng.php">������</a></li>               			
                        <?
						}
						?>    

                           <? 																
						if ($Mode=="�������������")
						{
						?>                                            
						<li><a href="user.php">������������</a></li>					
                        <?
						}
						?>                        
                        
                         <? 																
						if ($Mode=="��������")
						{
						?>                                            
						<li><a href="reqdir.php">������</a></li>					
                        <?
						}
						?>  
																
                         <? 																
						if ($Mode=="�����������")
						{
						?>                                            
						<li><a href="reqwrk.php">������</a></li>					
                        <?
						}
						?>  						

                         <? 																
						if ($Mode=="������")
						{
						?>                                            
						<li><a href="reqclt.php">������</a></li>					
                        <?
						}
						?>  	                                
                                
                                
                           <? 																
						if ($Mode!="")
						{
						?>
                                                                
					     <li><a href="about.php">� �����</a></li>
                         <li><a href="#"><? echo "$fio";?></a></li>                            
                         <li><a href="index.php?step=2">�����</a></li>                          
                        <?
						}
						?>  
                        
                                        

				</ul>
			</div>