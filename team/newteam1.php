<?
 // $Id: newteam1.php,v 1.9 2003/05/27 18:38:29 thejet Exp $
 //
 // Team creation, step 1.  This will soon be modified to have a
 // psecure wrapper to only allow team creation to be performed
 // by an authenticated participant.  

 $title = "New Team Creation - Information";

 include "../etc/config.inc";
 include "../etc/modules.inc";
 include "../etc/project.inc";
 
 unset($proj_name);
 $lastupdate = last_update('t');
 include "../templates/header.inc";
?>
<div style="text-align: center">
   <h2>Team Registration Center</h2>
   <p>
    <i>Notice: It is very important that you read and understand the 
       following before continuing.</i>
   </p>
   <table border="0" width="60%" style="margin: auto; text-align: left">
   <tr>
     <td>
       <ul>
       <li>It is quite likely that you do not need to register a team.
           <br>
           Unless you are the official coordinator of a group of participants,
           you do not need to create a team.<br><br></li>
       <li>If you are working alone, under your own email, you do not need to
           create a team.<br><br></li>
       <li>If you are a member of a large team, but cannot find your team
           listed, you should probably not be creating a team.  Only your team
           coordinator needs to perform this step.
           <br>
           If your team is not listed, contact your coordinator and make sure
           your team is added properly.<br><br></li>
       <li>If you have not even looked to see if your team exists, you should
           NOT be creating a team.  The stats system will allow similar teams
           to be created, so if you create a team that is redundant,
           your effort will become split.  You have been warned.<br><br></li>
       <li>If there are other, existing teams that are similar to the team you
           are thinking about adding, perhaps you should reconsider your plans.<br><br></li>
       </ul>
     </td>
   </tr>
   </table>
   <p>
    <a href="newteam2.php">OK, OK, I still think that I'm doing the right thing</a>
   </p>
</div>
</body>
</html>
