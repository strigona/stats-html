<?
 # vi: ts=2 sw=2 tw=120
 # $Id: phistory.php,v 1.11 2003/03/09 12:19:55 paul Exp $

 // Variables Passed in url:
 //   id == Participant ID

 include "../etc/config.inc";
 include "../etc/modules.inc";
 include "../etc/project.inc";

 if(file_exists($lockfile)) {
   $title = "Participant History (Unavailable)";
   include "../templates/header.inc";
   include "../templates/updating.inc";
   exit;
 }

 $qs = "p_participant_all $id";
 sybase_query("set rowcount 0");
 $result = sybase_query($qs);
 err_check_query_results($result);

 sybase_data_seek($result,0);
 $person = sybase_fetch_object($result);
 $participant = participant_listas($person->listmode,$person->email,$id,$person->contact_name);

 $retire_to = (int) $person->retire_to;
 if( $retire_to > 0 ) {
   header("Location: http://stats.distributed.net/generic/phistory.php?project_id=$project_id&id=$retire_to");
   exit();
 }

 $lastupdate = last_update('ec');
 $qs = "p_phistory @project_id = $project_id, @id = $id";

 $title = "Participant History for $participant";

 include "../templates/header.inc";
?> 

<!-- IMPORTANT NOTE TO SCRIPTERS!
This page, like many stats pages, has a version which is far more suitable
for machine parsing.  Please try the url:
http://stats.distributed.net/generic/phistory_raw.php?project_id=$project_id&id=$id
-->
  <center>
    <p><a href="psummary.php?project_id=<?=$project_id?>&id=<?=$id?>">View <?=$participant?>'s Participant Summary</a></p>
    <table border="1" cellspacing"0">
      <tr>
       <th>Date</th>
       <th align="right"><?=$proj_unitname?></th>
       <th>&nbsp;</th>
      </tr>
<?

 $result = sybase_query($qs);
 $rows = sybase_num_rows($result);
 $maxwork_units = (double) 0;
 for ($i = 0; $i<$rows; $i++) {
   sybase_data_seek($result,$i);
   $par = sybase_fetch_object($result);
   $work_units = (double) $par->WORK_UNITS;
   if($work_units > $maxwork_units) {
     $maxwork_units = $work_units;
   }
   debug_text("<!-- work_units: $work_units, maxwork_units: $maxwork_units -->\n",$debug);
 }
 
 for ($i = 0; $i<$rows; $i++) {
   sybase_data_seek($result,$i);
   $par = sybase_fetch_object($result);
   $work_units = (double) $par->WORK_UNITS;
   $work_units_fmt = number_format($work_units,0);
   $date_fmt = sybase_date_format_long($par->DATE);
   $width = (int) (($work_units / $maxwork_units) * 200)+1;

   debug_text("<!-- work_units: $work_units, maxwork_units: $maxwork_units -->\n",$debug);
   ?>
      <tr class=<?=row_background_color($i);?>>
        <td><?=$date_fmt?></td>
        <td align="right"><?=$work_units_fmt?></td>
        <td align="left"><img src="/images/bar.jpg" height="8" width="<?=$width?>"></td>
      </tr>
<?
 }
?>
    </table>
    <p><a href="psummary.php?project_id=<?=$project_id?>&id=<?=$id?>">View <?=$participant?>'s Participant Summary</a></p>
  </center>
<?include "../templates/footer.inc";?>
