<h1>Editar os Posts</h1>

<?php if ($this->session->flashdata('error') == TRUE): ?>
		<p><?php echo $this->session->flashdata('error'); ?></p>
	<?php endif; ?>
	<?php if ($this->session->flashdata('success') == TRUE): ?>
		<p><?php echo $this->session->flashdata('success'); ?></p>
	<?php endif; ?>


<hr>
<br>

	<form method="post" action="<?=base_url('atualizar')?>" enctype="multipart/form-data">
		<div>
			<label>Title:</label>
			<input type="text" name="title" value="<?=$post['title']?>" required/>
		</div>

	
			<label><em>Todos os campos são obrigatórios.</em></label>
            <input type="hidden" name="id" value="<?=$post['id']?>"/>
			<input type="submit" value="Salvar"/>
		</div>
	</form>