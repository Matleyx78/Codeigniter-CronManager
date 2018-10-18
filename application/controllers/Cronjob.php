<?php if (! defined('BASEPATH')) { exit('No direct script access allowed');}


class Cronjob extends CI_Controller
{
    public function __construct()
        {
            parent::__construct();
        }

    public function run()
        {
        if (!$this->input->is_cli_request())
            {
                show_error('Direct access is not allowed');
            }
        $this->load->library('CronRunner');
        $cron = new CronRunner();
        $cron->run();
        }
}
