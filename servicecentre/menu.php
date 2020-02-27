<meta http-equiv="Content-Type" content="text/html; charset=windows-1251">
			<div id="menu" >
				<ul>



	                    <?

						if ($Mode=="Менеджер")
						{
						?>
                        <li><a href="service.php">Услуги</a></li>
                        <li><a href="reqmng.php">Заявки</a></li>               			
                        <?
						}
						?>    

                           <? 																
						if ($Mode=="Администратор")
						{
						?>                                            
						<li><a href="user.php">Пользователи</a></li>					
                        <?
						}
						?>                        
                        
                         <? 																
						if ($Mode=="Директор")
						{
						?>                                            
						<li><a href="reqdir.php">Заявки</a></li>					
                        <?
						}
						?>  
																
                         <? 																
						if ($Mode=="Исполнитель")
						{
						?>                                            
						<li><a href="reqwrk.php">Заявки</a></li>					
                        <?
						}
						?>  						

                         <? 																
						if ($Mode=="Клиент")
						{
						?>                                            
						<li><a href="reqclt.php">Заявки</a></li>					
                        <?
						}
						?>  	                                
                                
                                
                           <? 																
						if ($Mode!="")
						{
						?>
                                                                
					     <li><a href="about.php">О сайте</a></li>
                         <li><a href="#"><? echo "$fio";?></a></li>                            
                         <li><a href="index.php?step=2">Выход</a></li>                          
                        <?
						}
						?>  
                        
                                        

				</ul>
			</div>