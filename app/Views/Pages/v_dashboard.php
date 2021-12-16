<?= $this->extend('structures/layout') ?>

<?= $this->section('content') ?>
<section>
    <div class="flex flex-col py-24 h-screen w-screen justify-center items-center">
        <div class=" w-1/3 bg-primary rounded-t-xl flex justify-center items-center flex-col py-4 ">
            <div class="w-24 h-24 rounded-full bg-white mb-2">
                <img class="max-h-full rounded-full" src="<?= base_url() ?>/img/photoprofiles/<?= session()->photo  ?>" alt="">
            </div>
            <p class="text-center font-bold text-lg text-white"><?= session()->name  ?></p>
        </div>
        <div class="w-1/3 bg-white rounded-b-2xl px-8 py-6 flex flex-col justify-center items-center">
            <div class="border-b-2 mb-2 self-start w-full">
                <p class="text-sm font-bold">Name</p>
                <div class="py-3">
                    <p class="text-base font-normal"><?= session()->name ?></p>
                </div>
            </div>
            <div class="border-b-2 mb-2 self-start w-full">
                <p class="text-sm font-bold">E-mail</p>
                <div class="py-3">
                    <p class="text-base font-normal"><?= session()->email ?></p>
                </div>
            </div>
            <a href="<?php echo base_url('logout'); ?>" class="mx-auto font-bold px-16 mt-6 py-3 bg-red-400 rounded-full text-white">LOGOUT</a>
        </div>
    </div>

</section>

<?= $this->endSection() ?>