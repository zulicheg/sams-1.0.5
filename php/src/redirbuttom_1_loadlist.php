<?php
/*  
 * SAMS (Squid Account Management System)
 * Author: Dmitry Chemerik chemerik@mail.ru
 * (see the file 'main.php' for license details)
 */

function LoadRedirList()
{
  global $SAMSConf;
  $lang="./lang/lang.$SAMSConf->LANG";
  require($lang);

  if(isset($_GET["listfilename"])) $listfilename=$_GET["listfilename"];
  if(isset($_GET["execute"])) $execute=$_GET["execute"];
  if(isset($_GET["type"])) $type=$_GET["type"];
  if(isset($_GET["id"])) $id=$_GET["id"];


  $SAMSConf->access=UserAccess();
  if($SAMSConf->access!=2)     {       exit;     }
  
 $listfilename=$_FILES["userfile"]["name"];
 PageTop("import_48.jpg","$redir_loadfurllist1 <BR>$listfilename");
  $aaa=copy($_FILES["userfile"]["tmp_name"], "data/urllist.txt");
  $finp=fopen("data/urllist.txt","r");
  if($finp==FALSE)
    {
      echo "can't open sams config file data/urllist.txt<BR>";
      exit(0);
    }
  while(feof($finp)==0)
    {
       $string=fgets($finp, 10000);
       $string=trim($string);
     //print("INSERT INTO urls SET urls.url=\"$string\",type=\"$id\" <BR> ");
       if(strlen($string)>1)
         $result=mysql_query("INSERT INTO urls SET urls.url=\"$string\",type=\"$id\" ");
    }
  fclose($finp);
  print("<SCRIPT>\n");
  print("  parent.tray.location.href=\"tray.php?show=exe&function=$execute&id=$id\";\n");
  print("</SCRIPT> \n");


}


/****************************************************************/

function LoadRedirListForm()
{
  global $SAMSConf;
  $lang="./lang/lang.$SAMSConf->LANG";
  require($lang);

  if(isset($_GET["id"])) $id=$_GET["id"];

   $SAMSConf->access=UserAccess();
   if($SAMSConf->access!=2)     {       exit;     }
  
  PageTop("import_48.jpg","$redir_loadfurllist1");
  print("<FORM NAME=\"LOADBACKUP\" ENCTYPE=\"multipart/form-data\" ACTION=\"main.php?show=exe&function=loadredirlist&filename=redirbuttom_1_loadlist.php&id=$id&type=redir&execute=redirlisttray \" METHOD=POST>\n");
  print("    <INPUT TYPE=\"HIDDEN\" NAME=\"MAX_FILES_SIZE\" value=\"1048576\">\n");
  print("<BR><INPUT TYPE=\"FILE\" NAME=\"userfile\" value=\"$redir_importurllistform1\">\n");
  print("<BR><INPUT TYPE=\"SUBMIT\" value=\"Load file\">\n");
  print("</FORM>\n");

}




function redirbuttom_1_loadlist()
{
  global $SAMSConf;
  
  $lang="./lang/lang.$SAMSConf->LANG";
  require($lang);

  if(isset($_GET["id"])) $id=$_GET["id"];

   if($SAMSConf->access==2)
    {
       print("<TD VALIGN=\"TOP\" WIDTH=\"10%\">\n");

GraphButton("main.php?show=exe&function=loadredirlistform&filename=redirbuttom_1_loadlist.php&id=$id","basefrm","import_32.jpg","import_48.jpg","$redir_redirtray2 ");
	}

}




?>
