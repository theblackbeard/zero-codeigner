<?php
    class Blog extends CI_Controller
    {
         public function __construct()
         {
            parent::__construct();	
         }
 
        public function index()
        {
            $posts = $this->post->GetAll('title');
            $dados['posts'] =$this->post->Formatar($posts);
            $this->load->view('posts/index', $dados);
        }

        public function salvar()
        {
            $posts = $this->post->GetAll('title');
            $dados['posts'] =$this->post->Formatar($posts);
            $validation = self::Validate();
            if($validation):
                $post = $this->input->post();
                $status = $this->post->Inserir($post);
                if(!$status):
                    $this->session->set_flashdata('error', 'Não foi possível inserir o contato.');
                else:
                    $this->session->set_flashdata('success', 'Contato inserido com sucesso.');
                    redirect('blog');
                endif;
            else:
                $this->session->set_flashdata('error', validation_errors('<p>','</p>'));
            endif;
            $this->load->view('posts/index',$dados);
        }

        public function editar()
        {
            $id = $this->uri->segment(3);
            if(is_null($id)) redirect('blog');
            $dados['post'] = $this->post->GetById($id);
            $this->load->view('posts/editar', $dados);
        }

        public function atualizar()
        {
            $validacao = self::Validate('update');
            if($validacao):
                $post = $this->input->post();
                $status = $this->post->Atualizar($post['id'],$post);
                if(!$status):
                    $dados['post'] = $this->post->GetById($post['id']);
				    $this->session->set_flashdata('error', 'Não foi possível atualizar o contato.');
                else:
                    $this->session->set_flashdata('success', 'Contato atualizado com sucesso.');
					redirect('blog');
                endif;
            else:
                $this->session->set_flashdata('error', validation_errors());   
            endif;
            $this->load->view('posts/editar',$dados);
        }

        public function excluir()
        {
            $id = $this->uri->segment(3);
            if(is_null($id)) redirect('blog');
            $status = $this->post->Excluir($id);
            if($status):
			    $this->session->set_flashdata('success', '<p>Contato excluído com sucesso.</p>');
		    else:
			    $this->session->set_flashdata('error', '<p>Não foi possível excluir o contato.</p>');
            endif;
		    redirect('blog');
        }

        public function status()
        {
            $id = $this->uri->segment(3);
            $stat = $this->uri->segment(4);
           
            if($stat): $stat = 0; else: $stat = 1; endif;
            $data = array("status" => $stat);
            $status = $this->post->Status($id, $data);
            if($status):
			    $this->session->set_flashdata('success', '<p>Contato excluído com sucesso.</p>');
		    else:
			    $this->session->set_flashdata('error', '<p>Não foi possível excluir o contato.</p>');
            endif;
		   redirect('blog');
        }

        private function Validate($operacao = 'insert'){
		// Com base no parâmetro passado
		// determina as regras de validação
		switch($operacao){
			case 'insert':
				$rules['title'] = array('trim', 'required', 'min_length[3]');
				//$rules['email'] = array('trim', 'required', 'valid_email', 'is_unique[contatos.email]');
				break;
			case 'update':
				$rules['title'] = array('trim', 'required', 'min_length[3]');
				//$rules['email'] = array('trim', 'required', 'valid_email');
				break;
			default:
				$rules['nome'] = array('trim', 'required', 'min_length[3]');
				$rules['email'] = array('trim', 'required', 'valid_email', 'is_unique[contatos.email]');
				break;
		    }
            $this->form_validation->set_rules('title', 'Title', $rules['title']);
            //$this->form_validation->set_rules('email', 'Email', $rules['email']);
            // Executa a validação e retorna o status
            return $this->form_validation->run();
	    }   

    }
