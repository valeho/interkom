<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Tovar
 *
 * @author a.victor
 */
class Tovar extends CI_Controller
{

    private $_data = array();
    private $_binData;
    private $_skidCode = "''";
    private $_is_login = FALSE;

    public function __construct()
    {
        parent::__construct();
        
        $this->load->helper('url');
        @$this->_binData = @$this->session->userdata('dataLogin');
		

        if (!is_null($this->_binData))
        {
            $this->_skidCode = "'" . $this->_binData['binaryData'] . "'";
            $this->_is_login = $this->_binData['logged_in'];
        }
    }

    public function index()
    {

        $this->load->helper('form');

        $skidki = $this->session->userdata('dataLogin');
//		print_r($this->session);
        $data['loginData'] = $skidki;
        $master = $this->load->database('master', TRUE, TRUE);
		$guid = $this->_skidCode;
        $sql = <<<EOL
                exec [dbo].[sp_tab_cart] $guid
EOL;
		//echo $sql;
		//$result = $this->db->query($sql);
		
        //print_r($master->query($sql)->result());
		//print_r($result->result());
        /*if ($result->num_rows() > 0)
        {
            $data['content'] = $result->result();
            foreach ($result->result() as $items)
            {
                $summ[] = $items->_amount;
            }
            $sum = array_sum($summ);

        }*/

        $word = "''";
        $numb = "''";
        $art = "''";
        $folder = 1;

        $start = 1;
//		echo "exec dbo.sp_tab_goods $start, $word, $numb, $art, $this->_skidCode, $folder, 0, 100, 0";
        $query = $master->query("exec dbo.sp_tab_goods $start, $word, $numb, $art, $this->_skidCode, $folder, 0, 100, 0");
        $arr = array();
        $id = array();
        if ($query->num_rows() > 0)
        {
            foreach ($query->result() as $row)
            {
                $st = 0;
                $st1 = 0;
                if ($row->_inwork > 0)
                {
                    $st1 = 1;
                }
                if ($row->_incart)
                {
                    $st = 1;
                }
                if ($row->_is == 0)
                {
                    $way = '-';
                }
                if ($row->_is == 1)
                {
                    $way = '+';
                }
                if ($row->_is == 2)
                {
                    $way = '~';
                }
                $arr[] = array(
                    'incart' => $st,
                    'inwork'    => $st1,
                    'id' => $row->_id,
                    'title' => $row->_descr,
                    'price' => number_format($row->_price, 0, '', ''),
                    'article' => $row->_art,
                    'code' => $row->_code,
                    'mkei' => $row->_ed,
                    'norm' => $row->_pack,
                    'new' => $row->_new,
                    'pic' => $row->_pic,
                    'is' => $way,
                    'defData' => ($this->_is_login) ? '<button class="btn_sel cart_btn_plus" type="button" '
                            . 'data-code="' . $row->_code . '" '
                            . 'data-article="' . $row->_art . '" '
                            . 'data-mkei="' . $row->_ed . '"'
                            . 'data-norm="' . $row->_pack . '"'
                            . 'data-id="' . $row->_id . '"'
                            . 'data-title="' . $row->_descr . '"'
                            . 'data-price="' . number_format($row->_price, 0, '', '') . '"'
                            . 'data-is="' . $way . '"'
                            . '> </button>' : '&nbsp;'
                );
            }
        }

        $this->load->view('tovar/tovar', array('loginData' => $skidki, 'arr' => $arr));
    }

	public function LoginForm() {
	$this->load->view('tovar/login', array('loginData' => $skidki, 'arr' => $arr));
	}

    public function check_news() {
        //print_r ($this->session->userdata('dataLogin'));
        $skidki = $this->session->userdata('dataLogin')['user_name'];
        $sql = "SELECT TOP 10 [last_new] FROM [web].[dbo].[sys_login] WHERE login = '$skidki'";
        //echo $sql;
        $web = $this->load->database('web', TRUE, TRUE);
        $resultUna = $web->query($sql);
        print_r($resultUna->result());
        $last_show = $resultUna->row()->last_new;
        if($last_show == '') $last_show = '0';
        //echo $last_show;
        $sql = "SELECT TOP 1000 [_id]
      ,[_title]
      ,[_text]
      ,[_datetime]
  FROM [web].[dbo].[news] WHERE _id > $last_show";
        //echo $sql;
        $resultUna = $web->query($sql);
        echo json_encode($resultUna->result(),  JSON_FORCE_OBJECT);
    }

    public function updatenew($id) {
        $skidki = $this->session->userdata('dataLogin')['user_name'];
        $sql = "UPDATE [dbo].[sys_login] SET
          last_new = '$id' where login = '$skidki'";
        $web = $this->load->database('web', TRUE, TRUE);
        $web->query($sql);
        echo $sql;

    }
    public function ajax_search()
    {
        $word = "'" . $this->input->post('title', TRUE) . "'";
        $numb = "'" . $this->input->post('code', TRUE) . "'";
        $art = "'" . $this->input->post('art', TRUE) . "'";
        $folder = ($this->input->post('group', TRUE)) ? $this->input->post('group', TRUE) : 1;
        $new = ($this->input->post('is_new', TRUE)) ? $this->input->post('is_new', TRUE) : 0;
        $accur = ($this->input->post('accur', TRUE)) ? $this->input->post('accur', TRUE) : 0; //accur

        if ($accur == 1)
        {
            //$word = "'" . $this->input->post('title', TRUE) . "'";
        }

        if ($this->input->post('start', TRUE))
        {
            $start1 = intval($this->input->post('start', TRUE) / 49) + 1;
        }
        else
        {
            $start1 = 1;
        }

        $query = $this->db->query("exec dbo.sp_tab_goods $start1, $word, $numb, $art, $this->_skidCode, $folder, $new, 50, $accur");
        $arr = array();
        $id = array();
        if ($query->num_rows() > 0)
        {
            $numb_n = $query->result()[0]->_top_n;
            $numb_fn = $query->result()[0]->_top_n;
            foreach ($query->result() as $row)
            {
                $st = 0;  $st1 = 0;
                if ($row->_inwork)
                {
                        $st = 1;
                }
                if ($row->_incart)
                {
                        $st = 1;
                }
                if ($row->_is == 0)
                {
                    $way = '-';
                }
                if ($row->_is == 1)
                {
                    $way = '+';
                }
                if ($row->_is == 2)
                {
                    $way = '~';
                }
                $arr[] = array(
                    'incart' => $st,
                    'inwork' => $st1,
                    'id' => $row->_id,
                    'title' => $row->_descr,
                    'price' => number_format($row->_price, 0, '', ''),
                    'article' => $row->_art,
                    'code' => $row->_code,
                    'mkei' => $row->_ed,
                    'norm' => $row->_pack,
                    'new' => $row->_new,
                    'pic' => $row->_pic,
                    'is' => $way,
                    'defData' => ($this->_is_login) ? '<button class="btn_sel cart_btn_plus" type="button" '
                            . 'data-code="' . $row->_code . '" '
                            . 'data-article="' . $row->_art . '" '
                            . 'data-mkei="' . $row->_ed . '"'
                            . 'data-norm="' . $row->_pack . '"'
                            . 'data-id="' . $row->_id . '"'
                            . 'data-title="' . htmlspecialchars($row->_descr) . '"'
                            . 'data-price="' . number_format($row->_price, 0, '', '') . '"'
                            . 'data-is="' . $way . '"'
                            . '> </button>' : '&nbsp;'
                );
            }

            $html = $this->load->view('tovar/tov', array('arr' => $arr), true);

            echo json_encode(array('status' => 1, 'html' => $html, 'count' => $start1));
        }
        else
        {
            echo json_encode(array('status' => 2));
        }
    }


    public function getNews() {
        $query = $this->db->query("exec dbo.sp_tab_news");
        if ($query->num_rows() > 0) {
           foreach ($query->result() as $row) {
               $arr[] =
                   array(
                       'title' => $row->_Fld13685,
                       'date'   => $row->_Date_Time,
                       'news'   => $row->_Fld13686,
                       'guid'   => $row->_guid
                   );
               //$row->_guid;
             /*  $arr['title'][] = $row->_Fld13685;
               $arr['news'][] = $row->_Fld13686;
               $arr['text'][] = $row->_Date_Time;*/
           }
        }

       //$this->ajax_search_nov($arr['guid'][0]);
        $html = '<table>'.$this->load->view('tovar/tov_news', array('arr' => $arr), true).'</table>';
        echo json_encode($html);
    }
#-------------------Функция отображения списка товаров в новостях
    public function ajax_search_nov($guid)
    {
        $word = "''";
        $numb = "''";
        $art = "''";
        $folder = 1;
        $start1 = 1;



        $query = $this->db->query("exec dbo.sp_tab_goods_nov $start1, $word, $numb, $art, $this->_skidCode, $folder, 0, 100, 0, \"$guid\"");
        $arr = array();
        $id = array();
       // print_r($query);
        if ($query->num_rows() > 0)
        {
            $numb_n = $query->result()[0]->_top_n;
            $numb_fn = $query->result()[0]->_top_n;
            foreach ($query->result() as $row)
            {
                $st = 0;  $st1 = 0;
                if ($row->_inwork)
                {
                    $st = 1;
                }
                if ($row->_incart)
                {
                    $st = 1;
                }
                if ($row->_is == 0)
                {
                    $way = '-';
                }
                if ($row->_is == 1)
                {
                    $way = '+';
                }
                if ($row->_is == 2)
                {
                    $way = '~';
                }
                $arr[] = array(
                    'incart' => $st,
                    'inwork' => $st1,
                    'id' => $row->_id,
                    'title' => $row->_descr,
                    'price' => number_format($row->_price, 0, '', ''),
                    'article' => $row->_art,
                    'code' => $row->_code,
                    'mkei' => $row->_ed,
                    'norm' => $row->_pack,
                    'new' => $row->_new,
                    'pic' => $row->_pic,
                    'is' => $way,
                    'defData' => ($this->_is_login) ? '<button class="btn_sel cart_btn_plus" type="button" '
                        . 'data-code="' . $row->_code . '" '
                        . 'data-article="' . $row->_art . '" '
                        . 'data-mkei="' . $row->_ed . '"'
                        . 'data-norm="' . $row->_pack . '"'
                        . 'data-id="' . $row->_id . '"'
                        . 'data-title="' . htmlspecialchars($row->_descr) . '"'
                        . 'data-price="' . number_format($row->_price, 0, '', '') . '"'
                        . 'data-is="' . $way . '"'
                        . '> </button>' : '&nbsp;'
                );
            }

            $html = '<table>'.$this->load->view('tovar/tov', array('arr' => $arr), true).'</table>';

            echo json_encode(array('status' => 1, 'html' => $html, 'count' => $start1));
        }
        else
        {
            echo json_encode(array('status' => 2));
        }
    }

    public function lk () {
       @$client = $this->session->userdata['dataLogin']['adress']->_uid;
      //  print_r($client);

        $sql = "
        exec dbo.sp_user_kl '$client'
        ";

        $master = $this->load->database('master', TRUE, TRUE);
        $resultUna = $master->query($sql);
        $skidki = $this->session->userdata('dataLogin');
        $data['loginData'] = $skidki;
        $data['tels'] = $resultUna->result();
        echo $this->load->view('tovar/lk', $data);

    }


    public function login()
    {
        $login = $this->input->post('login', TRUE);
        $passwd = '0x' . md5($this->input->post('passwd', TRUE));
        //$passwd = md5($this->input->post('passwd', TRUE));
        $sql = <<<EOL
                exec dbo.sp_user_info '$login', $passwd;
EOL;
        $master = $this->load->database('master', TRUE, TRUE);
        $resultUna = $master->query($sql);
        $data = date("d-m-Y h:i");
        $ip = $_SERVER['REMOTE_ADDR'];
        $ir='0';

        if ($resultUna->num_rows() == 1)
        {
            $dataUna = $resultUna->row();
            if ($dataUna->_uid == 'error')
            {
                $ir = '2';
                echo json_encode(array('status' => 2, 'message' => 'Неправильный логин и пароль'));
            }
            else
            {

                $newdata = array('dataLogin' =>
                    array(
                        'user_name' => $login,
                        'logged_in' => TRUE,
                        'binaryData' => (!empty($dataUna)) ? $dataUna->_uid : '',
                        'compname' => $dataUna->_pname,

                        'balance'   => $dataUna ->_Balance,
                        'adress' => $dataUna

                    )
                );
                $this->session->set_userdata($newdata);
                $summ_cart = $this->showSumm($dataUna->_uid);
                $this->session->set_userdata('summcart', $summ_cart);
                $ir = '1';
      //          $sql = "insert into dbo.login_history VALUES ('$login', '$data', '$ip', '$ir')";
                echo json_encode(array('status' => 1, 'message' => "Вход успешно выполнен", 'username' => $login, 'binaryData' => (!empty($dataUna)) ? $dataUna->_uid : ''));
            }
        }
        else
        {
            echo json_encode(array('status' => 2, 'message' => $SQL_1));
            $ir = '2';
        }
//        $sql = "insert into dbo.login_history ([_login], [_result], [_ip]) VALUES ('$login', '$ir', '$ip')";
  //      $web = $this->load->database('web', TRUE, TRUE);
    //    $web->query($sql);
//		redirect('/opt/tovar');
    }
    
    public function login_n()
    {
        $login = $this->input->post('login', TRUE);
        $passwd = '0x' . md5($this->input->post('passwd', TRUE));

        $sql = <<<EOL
                exec dbo.sp_user_info '$login', $passwd;
EOL;

        $master = $this->load->database('master', TRUE, TRUE);
        $resultUna = $master->query($sql);

        if ($resultUna->num_rows() == 1)
        {
            $dataUna = $resultUna->row();
            if ($dataUna->_uid == 'error')
            {
                redirect('/a2dsrc');
            }
            else
            {
                $newdata = array('dataLogin' =>
                    array(
                        'user_name' => $login,
                        'logged_in' => TRUE,
                        'binaryData' => (!empty($dataUna)) ? $dataUna->_uid : '',
                        'compname' => $dataUna->_pname,
                    )
                );
                $this->session->set_userdata($newdata);

                redirect('/tovar/index');
            }
        }
        else
        {
            redirect('/a2dsrc');
        }
    }

    public function logout()
    {
        $this->session->sess_destroy();
    }

    public function showSumm($guid)
    {
       // echo $guid;
        //$guid = $this->_skidCode;
        $sql = <<<EOL
                 SELECT dbo._ic_user_info('$guid', 'cart') _value;
EOL;
        $master = $this->load->database('master', TRUE, TRUE);
        $resultUna = $master->query($sql);
        $val =  $resultUna->result();
        $this->session->set_userdata('summcart', $val[0]->_value);

        return $val[0]->_value;



    }
    public function echoshowSumm($guid)
    {
        // echo $guid;
        //$guid = $this->_skidCode;
        $sql = <<<EOL
                 SELECT dbo._ic_user_info('$guid', 'cart') _value;
EOL;
        $master = $this->load->database('master', TRUE, TRUE);
        $resultUna = $master->query($sql);
        $val =  $resultUna->result();
        $this->session->set_userdata('summcart', $val[0]->_value);

        echo $val[0]->_value;



    }
    public function showFormCart()
    {
        $data['post'] = $this->input->post(NULL, TRUE);
        echo $this->load->view('/tovar/layout/_formAddToCart', $data, TRUE);
    }

    public function addToCart()
    {
        $post = $this->input->post(NULL, TRUE);
        $object_id = $post['object_id'];
        $count = $post['count'];
        $price = $post['price'];
        $guid = $this->_skidCode;

        $sql = <<<EOL
                exec dbo.sp_add_to_cart $guid, '$object_id', $count, $price
EOL;
		
        try
        {
	        $master = $this->load->database('master', TRUE, TRUE);
            $master->query($sql);
            $this->session->set_userdata('summcart', $this->session->userdata('summcart') + ($count*$price));
            echo json_encode(array('status' => 1, 'summcart' => $this->session->userdata('summcart')));

        }
        catch (Exception $ex)
        {
            echo json_encode(array('status' => 2, 'message' => 'Ошибка выполнения запроса'));
        }
    }

    public function cart()
    {
        $skidki = $this->session->userdata('dataLogin');
        $data['loginData'] = $skidki;
        $guid = $this->_skidCode;
		$master = $this->load->database('master', TRUE, TRUE);
        $sql = <<<EOL
                exec dbo.sp_tab_cart $guid
EOL;
		echo $sql;
		
        $result = $master->query($sql);
        if ($result->num_rows() > 0)
        {
            $data['content'] = $result->result();
            foreach ($result->result() as $items)
            {
                $summ[] = $items->_amount;
            }
            $data['sum'] = array_sum($summ);
            $this->load->view('tovar/cart', $data);
        }
        else
        {
            $this->load->view('tovar/empty_cart', $data);
        }
    }
    public function ajax_search_magazine($id)
    {

        $par = $this->uri->segment('4');
        //echo $par;
        $query = $this->db->query("exec dbo.sp_tab_chklist '$id'");
        //echo $this->db->last_query();
        $arr = array();
        $id = array();
        if ($query->num_rows() > 0)
        {
            foreach ($query->result() as $row)
            {
                $arr[] = array(
                    'npp' => $row->_npp,
                    'descr' => $row->_descr,
                    'ed' => $row->_ed,
                    'code' => $row->_code,
                    'art' => $row->_art,
                    'count' => $row->_count,
                    'exec'  => $row->_exec,
                    'price' => $row->_price,
                    'amount' => $row->_amount,
                    'amount_exec' => $row->_amount_exec,

                    /* 'amount' => number_format($row->_amount, 0, '', ''), */



                );
                $summ[] = $row->_amount;
                $summ_exec[] = $row->_amount_exec;
        //$id[] = $row->id;
            }

            echo json_encode(array('data' => $arr, "recordsTotal" => 1, "recordsFiltered" => 1, "summ" => array_sum($summ), "summ_exec" => array_sum($summ_exec)));
        }
        else
        {
            echo json_encode(array('status' => 2));
        }
    }

    public function ajax_search_cart()
    {
        $draw = ($this->input->get('draw', TRUE)) ? $this->input->get('draw', TRUE) : 0;

        if ($this->input->get('start', TRUE))
        {
            $start = $this->input->get('start', TRUE) / 50 + 1;
        }
        else
        {
            $start = 1;
        }
		$master = $this->load->database('master', 'true', 'true');
        $query = $master->query("exec dbo.sp_tab_cart $this->_skidCode");
//        echo $this->db->last_query();
        $arr = array();
        $id = array();
        if ($query->num_rows() > 0)
        {
            foreach ($query->result() as $row)
            {

                $arr[] = array(
                    'id' => $row->_id,
                    'title' => $row->_descr,
                    'amount' => '<span id="price' . $row->_id . '">' . number_format($row->_amount, 0, '', '') . '</span>',
                    /* 'amount' => number_format($row->_amount, 0, '', ''), */
                    'article' => $row->_art,
                    'code' => $row->_code,
                    'mkei' => $row->_ed,
                    'norm' => $row->_pack,
                    'count' => '<input type="text" value="' . $row->_count . '" class="form-control input-sm" style="text-align: right;" onkeyup="updCart(this)" data-tovar-id="' . $row->_id . '" data-amount="' . number_format($row->_price, 0, '', '') . '">',
                    'defData' => '<a href="#" onclick="delItem(this);
                                                return false;" data-tovar-id="' . $row->_id . '"><i class="glyphicon glyphicon-trash"></i></a>'
                );
                //$id[] = $row->id;
            }
            echo json_encode(array("draw" => $draw, 'data' => $arr, "recordsTotal" => 1, "recordsFiltered" => 1,));
        }
        else
        {
            echo json_encode(array('status' => 2));
        }
    }

    public function updCart()
    {
        $colvo = $this->input->post('colvo', TRUE);
        $amount = $this->input->post('amount', TRUE);
        $tovar_id = $this->input->post('tovar_id', TRUE);
        $guid = $this->_skidCode;

        try
        {
            $sql = <<<EOL
                exec dbo.sp_update_cart $guid, '$tovar_id', $colvo, $amount
EOL;
            $this->db->query($sql);

            $sql_2 = <<<EOL
                exec dbo.sp_tab_cart $guid
EOL;
            $result_l = $this->db->query($sql_2);
            if ($result_l->num_rows() > 0)
            {
                foreach ($result_l->result() as $items)
                {
                    $summ[] = $items->_amount;
                }
                $sum = array_sum($summ);
            }
            else
            {
                $sum = 0;
            }

            echo json_encode(array('status' => 1, 'summa' => $sum));
        }
        catch (Exception $ex)
        {
            echo json_encode(array('status' => 2, 'message' => 'Ошибка выполнения запроса'));
        }
    }

    public function delCart()
    {
        $tovar_id = $this->input->post('tovar_id', TRUE);
        $guid = $this->_skidCode;
        try
        {
            $sql = <<<EOL
                exec dbo.sp_del_from_cart $guid, '$tovar_id'
EOL;
            $this->db->query($sql);
            echo json_encode(array('status' => 1));
        }
        catch (Exception $ex)
        {
            echo json_encode(array('status' => 2, 'message' => 'Ошибка выполнения запроса'));
        }
    }

    public function delAllCart()
    {
        $tovar_id = '*';
        $guid = $this->_skidCode;
       // echo $guid;
        try
        {
            $sql = <<<EOL
                exec dbo.sp_del_from_cart $guid, '$tovar_id'
EOL;
            //echo $sql;
            $this->db->query($sql);
            echo json_encode(array('status' => 1));
        }
        catch (Exception $ex)
        {
            echo json_encode(array('status' => 2, 'message' => 'Ошибка выполнения запроса'));
        }
    }

    public function confirmCart()
    {
        $this->mail_report();
        $skidki = $this->session->userdata('dataLogin');
        $guid = $this->_skidCode;
        echo $guid;
        $sql = <<<EOL
                exec dbo.sp_confirm_chk $guid
EOL;
        echo $sql;
        $result = $this->db->query($sql);
        $row = $result->row();

//print_r ($row);
        if (is_null($row->_result))
        {
            echo json_encode(array('status' => 2, 'message' => 'Не возможно подтвердить заказ'));
        }
        else
        {
            //mail("e.rezonov@yandex.ru", "Заказ с сайта", $row->_result);
            echo json_encode(array('status' => 1));
            $this->session->set_userdata('summcart', 0);
        }
    }

    private function mail_report($mess='') {
        $guid = $this->_skidCode;
        $this->session->userdata('dataLogin');
        $sql = <<<EOL
                exec dbo.sp_tab_cart $guid
EOL;
        $result = $this->db->query($sql);
        $this->load->dbutil();

        $this->load->helper('file');
        $this->load->helper('download');
        $delimiter = ";";
        $newline = "\r\n";

        $row = $result->row();
        $filename = "../".$this->session->userdata('dataLogin')['compname'].".csv";
        $fp = fopen ($filename, "w");
        //$data = $this->dbutil->csv_from_result($result, $delimiter, $newline);
        //force_download($filename, $data);
        //print_r($this->session->userdata('dataLogin'));
        $mess = date("d-M-Y H:i")." пришла заявка от <b>".$this->session->userdata('dataLogin')['compname']."</b><br /><br />";
        $mess .= '<table border="1" cellpadding="5">';
        $mess .= '<th>Код</th>';
        $mess .= '<th>Артикул</th>';
        $mess .= '<th>Название</th>';
        $mess .= '<th>Количество</th>';
        $mess .= '<th>Цена</th>';
        $mess .= '<th>Сумма</th>';
        $summ = 0;
        //$this->load->helper('csv');
        //$result = $result->result();
//		$data = $this->dbutil->csv_from_result($result, $delimiter, $newline);
//		        force_download($filename, $data);

        //echo array_to_csv($result, 'file.csv' );
        $c=1;
        $array = array(
            '№', 'Код', 'Артикул', 'Товар', 'ЕИ', 'Заявка'
        );
        $array = $this->utf8_converter($array);
        fputcsv($fp, $array, ';');
        foreach ($result->result() as $row)
        {
            $mess .= '<tr>';
            print_r($row);
            $array = array(
                $c, $row->_code, $row->_art, $row->_descr, $row->_ed, $row->_count
            );
            // $array =  (array) $row;
            $array = $this->utf8_converter($array);
            fputcsv($fp, $array, ';');
            $mess .= '<td>'.$row->_code.'</td>';
            $mess .= '<td>'.$row->_art.'</td>';
            $mess .= '<td>'.$row->_descr.'</td>';
            $mess .= '<td>'.$row->_count.'</td>';
            $mess .= '<td>'.$row->_price.'</td>';
            $mess .= '<td>'.$row->_amount.'</td>';
            $mess .= '</tr>';
            $summ = $summ + $row->_amount;
        }
        $mess .= '</table>';
        $mess .= 'Общая сумма:'.$summ;
        //$sum = array_sum($summ);
        fclose($fp);
        //force_download($filename, $data);
        $ci = get_instance();
        $ci->load->library('email');
        $config['protocol'] = "smtp";
        $config['smtp_host'] = "interkom.kz";
        $config['smtp_port'] = "25";
        $config['smtp_user'] = "stop@interkom.kz";
        $config['smtp_pass'] = "159123";
        $config['charset'] = "utf-8";
        $config['mailtype'] = "html";
        $config['newline'] = "\r\n";

        $ci->email->initialize($config);

        $ci->email->from('stop@interkom.kz', 'Сайт Opt.interkom.kz');
        $list = array('e.rezonov@yandex.ru', '122teran@mail.ru', 'info@interkom.kz');
//$list = array('e.rezonov@yandex.ru');
        $ci->email->to($list);
//$this->email->reply_to('my-email@gmail.com', 'Explendid Videos');
        $ci->email->subject('Пришла заявка с сайта от '.$this->session->userdata('dataLogin')['compname']);
        $ci->email->message($mess);
        $ci->email->attach($filename);
        $ci->email->send();
        unlink ($filename);
    }
    public function show_image()
    {
        $guid_pr = '150027BC-015D-0EF7-11E4-0B0ADE859581'; //'15001394-015D-0148-11E5-BD959F224E0E'; //$this->input->post('guid_pr', TRUE);
        $skidki = $this->session->userdata('dataLogin');
        $data['loginData'] = $skidki;
        $guid = $this->_skidCode;
        $sql = <<<EOL
                exec dbo.sp_info '$guid_pr', $guid
EOL;
        $result = $this->db->query($sql);
        $row = $result->row();

        //$picture = base64_decode(str_replace("&#xA;", "", $row->_img));
        //header('Content-type: image/jpg');
        //echo ($picture);
        //echo $row->_img;
        //$jpg = str_replace('AgFTS2/0iI3BTqDV67a9oKcN', '', base64_encode($row->_img));
        //$jpg = preg_replace('/[\n\r]/', '', $jpg);
        /*$jpg = base64_encode($row->_img);
        echo '<img src="data:image/jpeg;base64,' . $jpg . '">';*/

        $jpg = str_replace('AgFTS2/0iI3BTqDV67a9oKcN', '', $row->_img);
        $jpg = preg_replace('/[\n\r]/', '', $jpg);
        $jpg = base64_decode($jpg);
        $jpg = gzinflate($jpg);
        $start = chr(hexdec('ff')) . chr(hexdec('d8'));
        $jpg = substr($jpg, strpos($jpg, $start));

        $fp = fopen($filename, 'wb');
        $test = fwrite($fp, $jpg);
        fclose($fp);
    }
    private function utf8_converter($array)
    {
        array_walk_recursive($array, function(&$item, $key){
            //if(!mb_detect_encoding($item, 'utf-8', true)){
            $item = mb_convert_encoding($item, "windows-1251", "utf-8");
            // }
        });

        return $array;
    }
	public function allimage() {
    $ar = $this->uri->segments['3'];
	//echo $ar;
	$files = glob("E:/site/_fstore/_pics/".$ar."*.j*"); // Получаем все html-файлы из директории
	//print_r($files);

	echo "<img class=\"mainPic\" width=\"500px\" src=\"http://opt.interkom.kz/img/_fstore/_pics/".basename($files[0])."\" />";

    foreach($files as $image) {

        echo '<img class="new_image" src="http://opt.interkom.kz/img/_fstore/_pics/'.basename($image).'" width="200px">';
	}
	}
    public function image_new ($image) {
        ob_flush();
        header('Content-Type:image/jpeg');
        $config['image_library'] = 'imagemagick'; // выбираем библиотеку
        $config['source_image']	= 'E:/site/_fstore/_pics/'.$image;
        $config['dynamic_output'] = TRUE;
        $config['maintain_ratio'] = TRUE; // сохранять пропорции
        $config['width']	= 500; // и задаем размеры
        $this->load->library('image_lib', $config); // загружаем библиотеку
        //echo $image;
        $this->image_lib->resize(); // и вызываем функцию
        //echo $this->image_lib->display_errors();
        ob_end_flush();
    }
}
