<?php
defined('BASEPATH') or exit('No direct script access allowed');

class CronRunner
    {
        private $CI;

    public function __construct()
        {
            $this->CI =& get_instance();
            $this->CI->load->database();
        }

    private function calculateNextRun($obj)
        {
            return (time() + $obj->cicj_interval_sec);
        }

    public function run()
        {
            $query = $this->CI->db->where('cicj_is_active', 1)->where('now() >= cicj_next_run_at OR cicj_next_run_at IS NULL', '', false)->from('ci_cron_job')->get();
            
            if ($query->num_rows() > 0)
                {
                $env = getenv('CI_ENV');
                
                foreach ($query->result() as $row)
                    {
                        $cmd = $row->cicj_command;
                        //$cmd = "export CI_ENV={$env} && {$row->cicj_command}";
                        $this->CI->db->set('cicj_next_run_at', 'FROM_UNIXTIME('.$this->calculateNextRun($row).')', false)->where('id_ci_cj', $row->id_ci_cj)->update('ci_cron_job');
                        $output = shell_exec($cmd);
                        $this->CI->db->set('cicj_last_run_at', 'now()', false)->where('id_ci_cj', $row->id_ci_cj)->update('ci_cron_job');
                    }
                } 
        }
}
