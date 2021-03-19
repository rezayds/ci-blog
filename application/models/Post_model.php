<?php

class Post_model extends CI_Model{
    public function __construct(){
        $this->load->database();
    }

    public function get_posts($slug = FALSE, $limit = FALSE, $offset = FALSE){
        if ($limit) {
            $this->db->limit($limit, $offset);
        }
        if ($slug === FALSE) {
            $this->db->order_by('posts.id', 'DESC');
            $this->db->join('categories', 'categories.id = posts.category_id');
            $query = $this->db->get('posts');
            return $query->result_array();
        }

        $query = $this->db->get_where('posts', array('slug' => $slug));
        return $query->row_array();
    }

    public function view_post($slug){
        $this->db->order_by('posts.id', 'DESC');
        $this->db->join('categories', 'categories.id = posts.category_id');
        $query = $this->db->get_where('posts', array('slug' => $slug));
        return $query->row_array();
    }

    public function create_post($post_image,$user_id){
        $slug = url_title(strtolower($this->input->post('title')));

        $data = array(
            'title'         => $this->input->post('title'),
            'slug'          => $slug,
            'body'          => $this->input->post('body'),
            'user_id'       => $user_id,
            'category_id'   => $this->input->post('category_id'),
            'post_image'    => $post_image,
        );

        return $this->db->insert('posts', $data);
    }

    public function delete_post($slug){
        $this->db->where('slug', $slug);
        $this->db->delete('posts');
        return true;
    }

    public function update_post($post_image){
        $slug = url_title(strtolower($this->input->post('title')));

        $data = array(
            'title'         => $this->input->post('title'),
            'slug'          => $slug,
            'body'          => $this->input->post('body'),
            'category_id'   => $this->input->post('category_id'),
            'post_image'    => $post_image,
        );

        $this->db->where('id', $this->input->post('id'));
        return $this->db->update('posts', $data);
    }

    public function get_categories(){
        $this->db->order_by('name');
        $query = $this->db->get('categories');
        return $query->result_array();
    }

    public function get_posts_by_category($category_id){
        $this->db->order_by('posts.id', 'DESC');
        $this->db->join('categories', 'categories.id = posts.category_id');
        $query = $this->db->get_where('posts', array('category_id' => $category_id));
        return $query->result_array();

    }
}

?>
