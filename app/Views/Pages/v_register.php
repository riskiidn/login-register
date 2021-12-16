<?= $this->extend('structures/layout.php') ?>

<?= $this->section('content') ?>

<div class="w-screen h-screen py-10 px-20 relative">
	<?php if (session()->getFlashdata('success')) { ?>
		<div class="text-center absolute z-0 top-0 left-0 right-0 flex flex-col items-center py-4">
			<div id="error.<?= $i++ ?>" class="w-1/2 shadow-lg transition-all bg-red-400 p-4 rounded-xl px-10 py-4 text-xs mb-2 font-bold text-white flex justify-between">
				<?php echo session()->getFlashdata('success'); ?>
				<button onClick="removeButton(document.getElementById('error.<?= ($i++) - 1 ?>'))">x</button>
			</div>

		</div>
	<?php } ?>

	<?php if (session()->getFlashdata('error')) { ?>
		<div class="text-center absolute z-0 top-0 left-0 right-0 flex flex-col items-center py-4">
			<?php $i = 1;
			foreach (session()->getFlashdata('error') as $field => $error) : ?>
				<div id="error.<?= $i++ ?>" class="w-1/2 shadow-lg transition-all bg-red-400 p-4 rounded-xl px-10 py-4 text-xs mb-2 font-bold text-white flex justify-between">
					<p><?= $error ?></p>
					<button onClick="removeButton(document.getElementById('error.<?= ($i++) - 1 ?>'))">x</button>
				</div>
			<?php endforeach ?>
		</div>
	<?php } ?>

	<div class="w-full h-full z-50 rounded-2xl flex">
		<div class="w-6/12 bg-primary rounded-l-2xl shadow-lg flex justify-center items-center">
			<div class="w-7/12 flex flex-col justify-center items-center">
				<p class="text-3xl font-bold text-white mb-6 text-center">Already have an account ?</p>
				<a class="font-bold px-16 py-3 border-white border-2 rounded-full text-white" href="/login">LOGIN</a>
			</div>
		</div>
		<div id="content" class="w-8/12 px-32 py-10 bg-white rounded-r-2xl shadow-lg flex flex-col justify-center items-center overflow-auto overflow-x-hidden">
			<p class="text-3xl font-bold text-primary mb-2 text-center mt-10">Create Account</p>
			<p class="text-lg text-center text-primary mb-6">Please enter a valid info to create account</p>
			<?= form_open_multipart('register'); ?>
			<div class="flex items-center justify-center mb-4">
				<div onclick="uploadFoto()" class="cursor-pointer group relative flex p-1 justify-center items-center font-bold text-lg h-24 w-24 rounded-full bg-primary">
					<span class="hidden group-hover:flex text-2xl text-gray-500 text-center absolute">
						<i class="fas fa-camera"></i>
					</span>
					<img class=" max-h-full h-full w-full rounded-full" id="previewFoto" src="<?= base_url() ?>/img/photoprofiles/ava.png">
				</div>
			</div>
			<input accept="image/*" onchange="loadFile(event)" id="uploadFoto" type="file" name="uploadfoto" class="hidden"/>
			<input class="bg-mainBackground p-4 mb-2 rounded-2xl w-full outline-none text-sm placeholder:text-sm" placeholder="Name" type="text" name="name" id="InputForName" autocomplete="off">
			<input class="bg-mainBackground p-4 mb-2 rounded-2xl w-full outline-none text-sm placeholder:text-sm" placeholder="Email" type="email" name="email" id="InputForEmail" autocomplete="off">
			<input class="bg-mainBackground p-4 mb-2 rounded-2xl w-full outline-none text-sm placeholder:text-sm" type="password" name="password" id="InputForPassword" placeholder="Password">
			<div class="flex justify-center">
				<button type="submit" class="mx-auto font-bold px-16 mt-6 py-3 bg-primary rounded-full text-white">SIGN UP</button>

			</div>
			<?= form_close(); ?>
		</div>
	</div>
	<div class="circle one -z-10"></div>
	<div class="circle two -z-10"></div>
</div>

<?= $this->endSection() ?>