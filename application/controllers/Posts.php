<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Posts extends CI_Controller{

    public function index($offset = 0){
        // Pagination
        $config['base_url'] = base_url().'posts/index';
        $config['total_rows'] = $this->db->count_all('posts');
        $config['per_page'] = 3;
        $config['uri_segment'] = 3;

        // Pagination style config
        $config['full_tag_open']    = "<ul class='pagination'>";
        $config['full_tag_close']   = "</ul>";
        $config['num_tag_open']     = "<li>";
        $config['num_tag_close']    = "</li>";
        $config['cur_tag_open']     = "<li class='disabled'><li class='active'><a href='#'>";
        $config['cur_tag_close']    = "</a></li></li>";
        $config['next_tag_open']    = "<li>";
        $config['next_tagl_close']  = "</li>"; 
        $config['prev_tag_open']    = "<li>";
        $config['prev_tagl_close']  = "</li>"; 
        $config['first_tag_open']   = "<li>";
        $config['first_tagl_close'] = "</li>"; 
        $config['last_tag_open']    = "<li>";
        $config['last_tagl_close']  = "</li>"; 

        $this->pagination->initialize($config);

        $data['title'] = 'Latest Posts';

        $data['posts'] = $this->post_model->get_posts(FALSE, $config['per_page'], $offset);

        $this->load->view('templates/header');
        $this->load->view('posts/index', $data);
        $this->load->view('templates/footer');
    }

    public function view($slug = NULL){
        $data['post'] = $this->post_model->view_post($slug);
        $post_id = $data['post']['id'];
        $data['comments'] = $this->comment_model->get_comments($post_id);

        if (empty($data['post'])) {
            show_404();
        }

        $data['title'] = $data['post']['title'];

        $data['id_user'] = $data['post']['user_id'];
        $data['id_login'] = $this->session->userdata('user_id');

        $this->load->view('templates/header');
        $this->load->view('posts/view', $data);
        $this->load->view('templates/footer');
    }

    public function create(){
        if (!$this->session->userdata('logged_in')) {
            redirect('users/login');
        }

        $data['title'] = 'Create Post';

        $data['categories'] = $this->post_model->get_categories();

        $this->form_validation->set_rules('title', 'Title', 'required');
        $this->form_validation->set_rules('body', 'Body', 'required');

        if ($this->form_validation->run() === FALSE) {
            $this->load->view('templates/header');
            $this->load->view('posts/create', $data);
            $this->load->view('templates/footer');
        }else{
            $user_id = $this->session->userdata('user_id');
            // Upload Image
            if(!empty($_FILES['gambar']['name'])){
                $filename   = rand(1, 10000).'-'.$_FILES['gambar']['name'];
                $lowercase  = strtolower($filename);
                $post_image = str_replace(' ', '-', $lowercase);

                $config['file_name']    = $post_image;
            }
            $config['upload_path']      = './assets/images/posts';
            $config['allowed_types']    = 'gif|jpg|jpeg|png';
            $config['max_size']         = '2048';
            $config['max_width']        = '2560';
            $config['max_height']       = '1920';

            $this->load->library('upload', $config);

            if ($this->upload->do_upload('gambar')) {
                $data = array('upload_data' => $this->upload->data());
                $this->post_model->create_post($post_image,$user_id);
                $this->session->set_flashdata('success_message','<b>Well done!</b> Your post has been created');
                redirect('posts');
            }else{
                if(empty($post_image)){
                    $post_image = 'noimage.png';
                    $this->post_model->create_post($post_image,$user_id);
                    $this->session->set_flashdata('success_message','<b>Well done!</b> Your post has been created');
                    redirect('posts');
                }else{
                    $errors = $this->upload->display_errors();
                    $this->session->set_flashdata('error_message',$errors);
                    echo "<script>window.history.back();</script>";
                }
            }
        }
    }

    public function delete($slug, $post_image){
        if (!$this->session->userdata('logged_in')) {
            redirect('users/login');
        }

        $image = './assets/images/posts/'.$post_image;
        if($post_image != 'noimage.png'){
            unlink($image);
        }
        $this->post_model->delete_post($slug);
        $this->session->set_flashdata('error_message','Your post has been <b>deleted</b>');
        redirect('posts');
    }

    public function edit($slug){
        if (!$this->session->userdata('logged_in')) {
            redirect('users/login');
        }

        $data['post'] = $this->post_model->get_posts($slug);
        $data['categories'] = $this->post_model->get_categories();

        if (empty($data['post'])) {
            show_404();
        }

        $data['title'] = "Edit Post";

        $this->load->view('templates/header');
        $this->load->view('posts/edit', $data);
        $this->load->view('templates/footer');
    }

    public function update($slug, $post_image){
        if (!$this->session->userdata('logged_in')) {
            redirect('users/login');
        }
        
        $image_loc = './assets/images/posts/'.$post_image;

        $this->form_validation->set_rules('title', 'Title', 'required');
        $this->form_validation->set_rules('body', 'Body', 'required');

        if ($this->form_validation->run() === FALSE) {
            ?>
            <script type="text/javascript">window.history.back()</script>
            <?php
        }else{
            $image = $_FILES['gambar']['name'];
            if (empty($image)) {
                $this->post_model->update_post($post_image);
                $this->session->set_flashdata('success_message','<b>Well done!</b> Your post has been updated');
                redirect('posts');
            }else{
                unlink($image_loc);

                $filename   = rand(1, 10000).'-'.$_FILES['gambar']['name'];
                $lowercase  = strtolower($filename);
                $post_image = str_replace(' ', '-', $lowercase);

                $config['file_name']        = $post_image;
                $config['upload_path']      = './assets/images/posts';
                $config['allowed_types']    = 'gif|jpg|jpeg|png';
                $config['max_size']         = '2048';
                $config['max_width']        = '2560';
                $config['max_height']       = '1920';

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('gambar')) {
                    $data = array('upload_data' => $this->upload->data());
                    $this->post_model->update_post($post_image);
                    $this->session->set_flashdata('success_message','<b>Well done!</b> Your post has been updated');
                    redirect('posts');
                }else{
                    $errors = $this->upload->display_errors();
                    $this->session->set_flashdata('error_message',$errors);
                    echo "<script>window.history.back();</script>";
                }
            }
        }
    }
}
?>
