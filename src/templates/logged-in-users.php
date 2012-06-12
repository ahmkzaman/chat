<ul>
<?php foreach($users as $user ): ?>
    <li><?php echo htmlspecialchars($user->getNickname()); ?></li>
<?php endforeach; ?>
</ul>
