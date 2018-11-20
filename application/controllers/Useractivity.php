<?php
class Useractivity extends CI_Controller {
        public function __construct()
        {
            parent::__construct();
            $this->load->helper('url_helper');
            $this->load->model('User_activity_model');
        }
        
        public function set_activity(){
            $activity = $this->input->post('activity');
            $this->User_activity_model->set($activity);
        }

        function search()
        {
                $output = '';
                $query = '';
                if($this->input->post('query'))
                {
                        $query = $this->input->post('query');
                }
                $data = $this->User_activity_model->search($query);
                $output .= '
                <div class="table-responsive">
                <table class="table table-bordered ">
                <tr>
                <th>ID</th>
                <th>User</th>
                <th>Activity</th>
                <th>Datetime</th>
                </tr>
                ';
                if($data->num_rows() > 0)
                {
                        foreach($data->result() as $row)
                        {       
                                $output .= '
                                <tr>
                                <td>'.$row->id.'</td>
                                <td>'.$row->first_name.'</td>
                                <td>'.$row->activity.'</td>
                                <td>'.nice_date($row->date_time,'d-m-Y H:m').'</td>
                                </tr>
                                ';
                        }
                }
                else
                {
                        $output .= '<tr>
                        <td colspan="5">No Data Found</td>
                        </tr>';
                }
                $output .= '</table>';

                echo $output;
        }

        public function view(){
            $this->load->view('templates/header');
            $this->load->view('useractivity/view');
            $this->load->view('templates/footer');
        }

}