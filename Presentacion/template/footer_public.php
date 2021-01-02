<footer>
    <div class="py-4">
        <p class="text-center">&copy; Karen Rodriguez</p>
    </div>
</footer>
<script>
    const base_url = "<?= base_url(); ?>";
</script>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha256-4+XzXVhsDmqanXGHaHvgh1gMQKX40OUvDEBTu8JcmNs=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js" integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous"></script>
<script src="<?= media(); ?>js/b5/bootstrap.min.js"></script>

<?php if ($data['script']) { ?>
    <script src="<?= media(); ?><?= $data['script']; ?> "></script>
<?php } ?>
</body>

</html>