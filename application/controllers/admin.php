<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Admin extends CI_Controller
{

    private $_data = array();
    private $_is_admin = FALSE;

    public function __construct()
    {
        parent::__construct();

        //$this->load->library('session');

    }

    public function index()
    {
        $this->load->helper('url');
        if ($this->session->userdata('adminLogin') == '') {
            $this->load->view('admin/login');
        } else {

            $this->stat();
        }
        //echo "Админочка";
    }

    //log the user in

    public function login_form() {
        $this->load->view('admin/login');
    }
    public function login()
    {
        $login = $this->input->post('username', TRUE);
        $pass = $this->input->post('password', TRUE);

        $sql = "SELECT TOP 1000 [id]
      ,[login]
      ,[password]
  FROM [web].[dbo].[admin_login]
  where login = '$login' and password='$pass'";

        $web = $this->load->database('web', TRUE, TRUE);
        $result = $web->query($sql);
        //echo $login;

        if($result->num_rows() < 1) {
           $res_output['status'] = '1';
        } else {
            $this->session->set_userdata('adminLogin', $this->input->post('username'));
            $this->session->set_userdata('authadmin', '1');
            $this->_is_admin = TRUE;
            $res_output['status'] = '2';
        }

        echo json_encode($res_output, JSON_FORCE_OBJECT);

    }

    //log the user out
    function logout()
    {
        //log the user out
        //$logout = $this->ion_auth->logout();
        $this->session->set_userdata('adminLogin', '');
        //redirect them to the login page
        //$this->session->set_flashdata('message', $this->ion_auth->messages());
        //redirect('admin/login', 'refresh');
        $this->index();
    }


    function stat()
    {
        if ($this->session->userdata('adminLogin') == '') {
            $this->_render_page('admin/login', @$this->data);
        } else {
            $sql = <<<EOL
SELECT TOP 1000 
      [_login]
      ,[_datetime]
      ,[_ip]
      ,[_result]
  FROM [web].[dbo].[login_history]
EOL;
            $web = $this->load->database('web', TRUE, TRUE);
            $resultQ = $web->query($sql);
            $data = $resultQ->result();
            //$data['loginData'] = $this->session->userdata;
            //print_r($resultQ->result());
            echo $this->load->view('admin/stat', array("arr" => $data));

        }
    }

    public function allclients()
    {
        if ($this->session->userdata('adminLogin') == '') {
            $this->_render_page('admin/login', @$this->data);
        } else {
            $web = $this->load->database("web", TRUE, TRUE);
            $sql = <<<EOL
exec dbo.sp_users_tab

EOL;

            $resultQ = $web->query($sql);
            $this->load->view('admin/allclients', array('arr' => $resultQ->result(), 'loginData' => $this->session->userdata));

        }
    }

    private function _render_page($view, $data = null, $render = false)
    {
        $this->viewdata = (empty($data)) ? @$this->data : $data;

        $view_html = $this->load->view($view, $this->viewdata, $render);

        if (!$render)
            return $view_html;
    }

    public function get_stat()
    {
        $sql = <<<EOL
            SELECT TOP 1000
                  [_login]
                  ,[_datetime]
                  ,[_ip]
                  ,[_result]
              FROM [web].[dbo].[login_history]
EOL;
        $web = $this->load->database('web', TRUE, TRUE);
        $resultQ = $web->query($sql);
        //$data['loginData'] = $this->session->userdata;
        // print_r($resultQ->result());
        $data = $resultQ->result();
        echo $this->load->view('admin/tables/logs', array("arr" => $data));
        // echo json_encode($resultQ->result(), JSON_FORCE_OBJECT);
    }

    public function get_all()
    {
        if ($this->session->userdata('adminLogin') == '') {
            $this->_render_page('admin/login', @$this->data);
        } else {
            $web = $this->load->database("web", TRUE, TRUE);
            $sql = <<<EOL
exec dbo.sp_users_tab

EOL;
            $resultQ = $web->query($sql);
            $data = $resultQ->result();
            echo $this->load->view('admin/tables/allclients', array("arr" => $data));
            // echo json_encode($resultQ->result(), JSON_FORCE_OBJECT);
        }
    }

    public function get_cart($guid) {
        $web = $this->load->database("web", TRUE, TRUE);
        $sql = <<<EOL
                exec dbo.sp_tab_cart '$guid'
EOL;
        $result = $this->db->query($sql);
        if ($result->num_rows() > 0)
        {
            $data['content'] = $result->result();
            foreach ($result->result() as $items)
            {
                $summ[] = $items->_amount;
            }
            $data['sum'] = array_sum($summ);
            $this->load->view('admin/cart', array("arr" => $data));
        }
        else
        {
            $this->load->view('admin/cart');
        }
    }

    public function get_add_admin() {
        $this->load->view('admin/forms/add_admin', $edit='0');
    }

    /**
     * @return array
     */
    public function get_edit_admin($id) {
        $sql = "SELECT TOP 1 [id],[login],[password] FROM [web].[dbo].[admin_login] where id = '$id'";
        $web = $this->load->database("web", TRUE, TRUE);
        $result = $web->query($sql);
        $data = $result->row();
        $data->add_view = 'admin/forms/add_admin';
        //$this->load->view('admin/forms/add_admin', $data);
        $this->load->view('admin/stat', $data);
    }

    public function add_admin() {
        $login = $this->input->post('login', TRUE);
        $password = $this->input->post('password', TRUE);
        $id = $this->input->post('id', TRUE);
        $web = $this->load->database("web", TRUE, TRUE);
        $data = date("d-m-Y h:i");
        //echo $this->input->post('edit', TRUE);
        if($this->input->post('edit', TRUE)==1) {
            $sql = "
            UPDATE [dbo].[admin_login]
   SET [login] = '$login'
      ,[password] = '$password'
 WHERE [id] = $id
            ";

        } else {
            $sql = "INSERT INTO [dbo].[admin_login]
           ([login]
           ,[password]
           )
     VALUES
           ('$login'
           ,'$password'
          )";

        }

        echo $web->query($sql);
        //echo $sql;
    }

    public function del_admin($id) {
        $web = $this->load->database("web", TRUE, TRUE);
        $sql = "DELETE FROM [dbo].[admin_login] WHERE id = $id";
        $web->query($sql);
        $this->load->helper("url");
        redirect(dir.'/admin/');
    }
    public function get_admins() {
        $web = $this->load->database("web", TRUE, TRUE);
        $sql = "SELECT TOP 1000 [id], [login], [password] FROM [web].[dbo].[admin_login]";
        $resultQ = $web->query($sql);
        $data = $resultQ->result();
        $this->load->view('admin/tables/admins', array("arr" => $data));
    }

        public function get_show_new($id) {
                $web = $this->load->database("web", TRUE, TRUE);
                $sql = "SELECT [id], [title], [text], [time] FROM [web].[dbo].[news] where [id] = $id";
            $resultQ = $web->query($sql);
            $data = $resultQ->row();

            $sql_who = "SELECT [login] from [web].[dbo].[sys_login] where [last_new] > $id-1";
            $resultW = $web->query($sql_who);
            $dataWho = $resultW->result();

            $this->load->view('admin/shownew', array("arr" => $data, "who" => $dataWho));
            
        }
    public function get_news() {
        $web = $this->load->database("web", TRUE, TRUE);
        $sql = "SELECT TOP 1000 [_id], [_title], [_text], [_datetime] FROM [web].[dbo].[news]";
        $resultQ = $web->query($sql);
        $data = $resultQ->result();
        $this->load->view('admin/tables/news', array("arr" => $data));
    }

    public function get_add_news() {
        $this->load->view('admin/forms/add_new');
    }

    public function add_new() {
        $title = $this->input->post('title', TRUE);
        $web = $this->load->database("web", TRUE, TRUE);

        $text = $this->input->post('text', TRUE);
        $data = date("d-m-Y h:i");
        $sql="INSERT INTO [dbo].[news]
           ([_title]
           ,[_text]
           )
     VALUES
           ('$title'
           ,'$text'
           );";
        $web->query($sql);
        echo $sql;
    }
}

/* End of file admin.php */
/* Location: ./application/controllers/admin.php */