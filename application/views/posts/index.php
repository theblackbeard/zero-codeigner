<h1>Todos os Posts</h1>

<?php if ($this->session->flashdata('error') == TRUE): ?>
		<p><?php echo $this->session->flashdata('error'); ?></p>
	<?php endif; ?>
	<?php if ($this->session->flashdata('success') == TRUE): ?>
		<p><?php echo $this->session->flashdata('success'); ?></p>
	<?php endif; ?>

<?php if($posts) : ?>
    <ul>
        <?php foreach($posts as $post): ?>
            <li><a href="<?= $post['editar_url'] ?>"><?= $post['title'] ?></a> - <a href="<?= $post['excluir_url']?>">Excluir</a> - <a href="<?= $post['status_url'] ?>"><?=$post['status'] ?></a></li>
        <?php endforeach; ?>
    </ul>
<?php endif;?>
<hr>
<br>

	<form method="post" action="<?=base_url('salvar')?>" enctype="multipart/form-data">
		<div>
			<label>Title:</label>
			<input type="text" name="title" value="<?=set_value('title')?>" required/>
		</div>

	<div>
			<label>Status:</label>
			<input type="text" name="status" value="<?=set_value('status')?>" required/>
		</div>
			<label><em>Todos os campos são obrigatórios.</em></label>
			<input type="submit" value="Salvar"/>
		</div>
	</form>
<?php if($post):	?>
<hr>
<br>
<h1>Postagens Ativas </h1>
<ul>
	<?php foreach($posts as $post) : ?>
		<?php if($post['status'] == '1'): ?>
			<li><?= $post['title'] ?></li>
		<?php endif; ?>
	<?php endforeach; ?>
</ul>
<?php endif; ?>