<?= $this->extend('structures/layout.php') ?>

<?= $this->section('content') ?>
<div class="w-screen h-screen md:py-10 md:px-20 p-4 relative">
	<?php if (session()->getFlashdata('success')) { ?>
		<div class="text-center absolute z-10 top-0 left-0 right-0 flex flex-col items-center px-4 py-4">
			<div id="success_info" class="md:w-1/2 w-full shadow-lg transition-all bg-green-400 p-4 rounded-xl px-10 py-4 text-xs mb-2 font-bold text-white flex justify-between">
				<?php echo session()->getFlashdata('success'); ?>
				<button onClick="removeButton(document.getElementById('success_info'))">x</button>
			</div>

		</div>
	<?php } ?>

	<?php if (session()->getFlashdata('error')) { ?>
		<div class="text-center absolute z-0 top-0 left-0 right-0 flex flex-col items-center px-4 py-4">
			<div id="error" class="md:w-1/2 w-full shadow-lg transition-all bg-red-400 p-4 rounded-xl px-10 py-4 text-xs mb-2 font-bold text-white flex justify-between">
				<p><?php echo session()->getFlashdata('error'); ?></p>
				<button onClick="removeButton(document.getElementById('error'))">x</button>
			</div>
		</div>
	<?php } ?>
	<div class="w-full h-full z-50 rounded-2xl flex md:flex-row flex-col-reverse">
		<div class="md:w-6/12 w-full bg-primary md:rounded-l-2xl rounded-b-2xl shadow-lg flex justify-center items-center">
			<div class="md:w-7/12 md:p-0 p-4 flex flex-col justify-center items-center">
				<p class="text-3xl font-bold text-white mb-2">Welcome Back</p>
				<p class="text-lg text-center text-white mb-6">If you don't have an account please sign up</p>
				<a class="font-bold px-16 py-3 border-white border-2 rounded-full text-white" href="/register">SIGN UP</a>
			</div>
		</div>
		<div class="md:w-8/12 w-full my-auto md:px-32 h-full p-4 flex justify-center flex-col bg-white md:rounded-r-2xl rounded-t-2xl shadow-lg">
			<p class="text-3xl font-bold text-primary mb-2 text-center">forgot Password</p>
			<p class="text-lg text-center text-primary mb-6">Enter your registered email to reset the password</p>
			<?= form_open('login/forgotpassword'); ?>
			<input class="bg-mainBackground p-4 mb-2 rounded-2xl w-full outline-none text-sm placeholder:text-sm" placeholder="E-Mail" type="text" name="email" id="email">
			<div class="flex justify-center mt-6">
				<button class="font-bold px-16 py-3 bg-primary rounded-full text-white">SEND LINK</button>
			</div>
			<?= form_close(); ?>
		</div>
	</div>
	<div class="circle one md:block hidden -z-10"></div>
	<div class="circle two md:block hidden -z-10"></div>
</div>

<?= $this->endSection() ?>