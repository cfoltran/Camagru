<div class="form-zone">
    <div class="form-body">
        <form method="POST" action="<?= URL ?>?url=reset&submit=reset">
            <h2 style="text-align: center">Reset your password 🆕</h2>
            <div class="info">
                <?= $info ?>
            </div>
            <div class="error">
                <?= $err ?>
            </div>
            <input type="hidden" name="key" value="<?= $_GET['key'] ?>">
            <input type="password" class="input-box" name="passwd1" placeholder="Enter password" required>
            <input type="password" class="input-box" name="passwd2" placeholder="Confirm your password" required>
            <button type="submit" class="btn btn-primary">Reset</button>
        </form>
    </div>
</div>