<?php


/**
 * Get valid disposition list for CDRs
 *
 * @return array List of valid dispositions
 */
function qc_get_disposition_types()
{
    return array('ANSWERED', 'NO ANSWER', 'BUSY', 'FAILED');
}


/**
 * Get available languages
 *
 * @return array List of languages
 */
function qc_get_languages()
{
    return array('english', 'georgian', 'russian');
}



/**
  * Set session flashdata for notifications
  *
  * @param string $style Style of alert, should be bootstraps own 'danger', 'success' and so on...
  * @param string $body alert message body
  * @return bool True on success, false otherwise
  */
function qc_set_flash_notif($style = 'primary', $body = false)
{
    if (!$body) {
        return false;
    }
    $ci =& get_instance();
    $ci->session->set_flashdata('msg_style', $style);
    $ci->session->set_flashdata('msg_body', $body);
    return true;
}


/**
 * Convert seconds to hh:mm:ss format
 *
 * @param string $seconds Seconds
 * @return string
 */
function qc_sec_to_min($sec = 0) {
    if ($sec == 0) {
        return "00:00";
    }
    $minutes = floor(($sec / 60) % 60);
    $seconds = $sec % 60;
    if ($minutes < 10) { $minutes = "0".$minutes; }
    if ($seconds < 10) { $seconds = "0".$seconds; }
    return $minutes.":".$seconds;
}


/**
 * Get application version
 *
 * @return string Application version
 */
function qc_get_version_string()
{
    $v = file_exists(APPPATH."/VERSION") ? "QuickCDR v".file_get_contents(APPPATH."/VERSION") : "";
    return $v;
}


/**
 * Get recording file path for specific call
 *
 * @param obj Call object
 * @return Empty string on error, or full path of recording file
 */
function qc_get_call_recording_path($call = false)
{
    $path = '';
    if (!$call) {
        return $path;
    }
    $ci =& get_instance();
	
    $hot_path = '/var/spool/asterisk/monitor';
    $cold_path = '/var/monitor_archive';	

    $t = $call->uniqueid;
    $t = explode(".", $t);
    $t = $t[0];
    $year   = date('Y',$t);
    $month  = date('m',$t);
    $day    = date('d',$t);
	
	$path = $hot_path."/".$year."/".$month."/".$day."/".$call->recordingfile;

    // Try searching in backup
    if (!is_file($path)) {
        $path = $cold_path."/".$year."/".$month."/".$day."/".$call->recordingfile;
        if (!is_file($path)) {
            $path = $hot_path."/".$year."/".$month."/".$day."/".$call->recordingfile;
        }
    }
    return $path;
}
