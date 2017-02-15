<?php if ($error): ?>
<p>The login credentials you supplied could not be recognized. Please try again.</p>
<?php endif; ?>

<div class="login form">
<?php echo $this->Form->create('User', array('action' => 'login'));?>
        <fieldset>
                <legend><?php __('Login: '); ?></legend>
        <?php
                echo $this->Form->input('username');
		echo "Password ";
                echo $this->Form->password('password');
        ?>
        </fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
