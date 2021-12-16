<?= $this->extend('structures/layout.php')?>

<?= $this->section('content') ?>

<div class="w-screen h-screen py-10 px-20 relative">
<?php if (session()->getFlashdata('success')) { ?>
                        <div class="text-center absolute z-10 top-0 left-0 right-0 flex flex-col items-center py-4">
                        <div id="success_info" class="w-1/2 shadow-lg transition-all bg-green-400 p-4 rounded-xl px-10 py-4 text-xs mb-2 font-bold text-white flex justify-between">
						<?php echo session()->getFlashdata('success'); ?>
									<button onClick="removeButton(document.getElementById('success_info'))">x</button>
								</div>    
						
                        </div>
                    <?php } ?>

                    <?php if (session()->getFlashdata('error')) { ?>
                        <div class="text-center absolute z-0 top-0 left-0 right-0 flex flex-col items-center py-4">
                            <?php $i = 1; foreach (session()->getFlashdata('error') as $field => $error) : ?>
                                <div id="error.<?= $i++?>" class="w-1/2 shadow-lg transition-all bg-red-400 p-4 rounded-xl px-10 py-4 text-xs mb-2 font-bold text-white flex justify-between">
									<p><?= $error ?></p>
									<button onClick="removeButton(document.getElementById('error.<?=($i++)-1?>'))">x</button>
								</div>
                            <?php endforeach ?>
                        </div>
                    <?php } ?>
	<div class="w-full h-full z-50 rounded-2xl flex">
		<div class="w-6/12 bg-primary rounded-l-2xl shadow-lg flex justify-center items-center">
			<div class="w-7/12 flex flex-col justify-center items-center">
			<p class="text-3xl font-bold text-white mb-2">Welcome Back</p>
			<p class="text-lg text-center text-white mb-6">If you don't have an account please sign up</p>
			<a class="font-bold px-16 py-3 border-white border-2 rounded-full text-white" href="/register">SIGN UP</a>
			</div>
		</div>
		<div class="w-8/12 flex-col px-32 bg-white rounded-r-2xl shadow-lg flex justify-center items-center">
		<p class="text-3xl font-bold text-primary mb-2 text-center">Login</p>
				<p class="text-lg text-center text-primary mb-6">Login to continue access the page</p>
					<?= form_open('login'); ?>
					<input class="bg-mainBackground p-4 mb-2 rounded-2xl w-full outline-none text-sm placeholder:text-sm" placeholder="E-Mail" type="text" name="email" id="email">
					<input class="bg-mainBackground p-4 mb-2 rounded-2xl w-full outline-none text-sm placeholder:text-sm" type="password" placeholder="Password" name="password" id="password">
					<a href="/login/forgotpassword" class="self-start text-primary text-sm" >Forgot password</a>
					<div class="flex justify-center mt-6">
					<button class="font-bold px-16 py-3 bg-primary rounded-full text-white" >LOGIN</button>
					</div>
				<?= form_close(); ?>
		</div>
	</div>
	<div class="circle one -z-10"></div>
	<div class="circle two -z-10"></div>
</div>

<?= $this->endSection() ?>