<div class="form-zone">
    <div class="form-body">
        <form method="POST" action="<?= URL ?>?url=feedback&submit=feedback">
            <h1>A problem ? Leave a feedback !</h1>
            <div class="info">
                <?= $info ?>
            </div>
            <div class="error">
                <?= $err ?>
            </div>
            <input type="text" class="input-box" name="login" placeholder="Login" required>
            <textarea class="input-box" name="feedback" placeholder="Describe the problem" required></textarea>
            <button type="submit" class="btn btn-primary">Send</button>
        </form>
    </div>
</div>