<div class="wrap bft-wrap">
	<h1><?php _e('Add/Edit a Webhook', 'broadfast');?></h1>
	
	<p><a href="admin.php?page=bft_webhooks"><?php _e('Back to webhooks', 'broadfast');?></a></p>

	<div class="postbox">
	<form method="post" class="bft-form wrap" onsubmit="return validateHookForm(this);">
		<div class="wrap">
			<p><label><?php _e('When someone:', 'broadfast');?></label> <select name="action">
				<option value="subscribe" <?php if(!empty($hook->action) and $hook->action == 'subscribe') echo 'selected';?>><?php _e('Subscribes', 'broadfast');?></option>
				<option value="unsubscribe" <?php if(!empty($hook->action) and $hook->action == 'unsubscribe') echo 'selected';?>><?php _e('Unsubscribes', 'broadfast');?></option>
			</select> <?php _e('To/from your mailing list', 'broadfast');?> </p>
									
			<p><label><?php _e('Webhook URL:', 'broadfast');?></label> <input type="text" name="hook_url" value="<?php echo empty($hook->id) ? '' : $hook->hook_url;?>" class="bftpro-url-field"></p>
			
			<p><?php _e("The following data can be passed as a JSON array from Arigato to the webhook if they are available. You can set your names for each variable. If a variable has no name, it will not be included in the JSON array.", 'broadfast');?></p>
			
			<p><?php _e('You can include several custom attributes with a predefined value in the request. You can use them for an API key, authorization keys, and so on.', 'broadfast');?></p>
			
			<table>
				<thead>
					<tr><th><?php _e('Field / Data', 'broadfast');?></th><th><?php _e('Variable name', 'broadfast');?></th><th><?php _e('Variable value', 'broadfast');?></th></tr>
				</thead>
				<tbody>
					<tr><td><b><?php _e('Subscriber  Name', 'broadfast');?></b></td>
					<td><input type="text" name="name_name" value="<?php echo empty($payload_config['name']) ? '' : $payload_config['name']['name'];?>"></td>
					<td><?php _e('Dynamic / provided by user', 'broadfast');?></td></tr>
					<tr><td><b><?php _e('Email address', 'broadfast');?></b></td>
					<td><input type="text" name="email_name" value="<?php echo empty($payload_config['email']) ? '' : $payload_config['email']['name'];?>"></td>
					<td><?php _e('Dynamic / provided by user', 'broadfast');?></td></tr>
				
					<tr><td><b><?php _e('Custom parameter 1', 'broadfast')?></b><br />
					<i><?php _e('Predefined variable 1', 'broadfast');?></i></td>
					<td><input type="text" name="custom_key1_name" value="<?php echo empty($payload_config['custom_key1']) ? '' : $payload_config['custom_key1']['name'];?>"></td>
					<td><input type="text" name="custom_key1_value" value="<?php echo empty($payload_config['custom_key1']) ? '' : $payload_config['custom_key1']['value'];?>"></td></tr>
					<tr><td><b><?php _e('Custom parameter 2', 'broadfast');?></b><br />
					<i><?php _e('Predefined variable 2', 'broadfast');?></i></td>
					<td><input type="text" name="custom_key2_name" value="<?php echo empty($payload_config['custom_key2']) ? '' : $payload_config['custom_key2']['name'];?>"></td>
					<td><input type="text" name="custom_key2_value" value="<?php echo empty($payload_config['custom_key2']) ? '' : $payload_config['custom_key2']['value'];?>"></td></tr>
					<tr><td><b><?php _e('Custom parameter 3', 'broadfast');?></b><br />
					<i><?php _e('Predefined variable 3', 'broadfast');?></i></td>
					<td><input type="text" name="custom_key3_name" value="<?php echo empty($payload_config['custom_key3']) ? '' : $payload_config['custom_key3']['name'];?>"></td>
					<td><input type="text" name="custom_key3_value" value="<?php echo empty($payload_config['custom_key3']) ? '' : $payload_config['custom_key3']['value'];?>"></td></tr>
				</tbody>
			</table>
			
			<p><input type="submit" value="<?php _e('Save Webhook', 'broadfast');?>" class="button button-primary">
			<input type="submit" name="test" value="<?php _e('Test Webhook', 'broadfast');?>" class="button button-primary"></p>
		</div>
		<?php wp_nonce_field('arigato_webhooks');?>
		<input type="hidden" name="ok" value="1">
	</form>
	</div>
	
	<?php if(!empty($_POST['test'])):?>
	<div>
		<h2><?php _e('Data sent', 'broadfast');?></h2>
			<p><?php echo '<pre>' . var_export($data, true) . '</pre>';;?></p>
		<h2><?php _e('Response from the hook', 'broadfast');?></h2>
		<p>
			<?php echo '<pre>' . var_export($result, true) . '</pre>';?>
		</p>
	</div>
	<?php endif;?>
</div>

<script type="text/javascript" >
function validateHookForm(frm) {
	var pattern = new RegExp('^(https?:\\/\\/)?'+ // protocol
    '((([a-z\\d]([a-z\\d-]*[a-z\\d])*)\\.)+[a-z]{2,}|'+ // domain name
    '((\\d{1,3}\\.){3}\\d{1,3}))'+ // OR ip (v4) address
    '(\\:\\d+)?(\\/[-a-z\\d%_.~+]*)*'+ // port and path
    '(\\?[;&a-z\\d%_.~+=-]*)?'+ // query string
    '(\\#[-a-z\\d_]*)?$','i'); // fragment locator	
	
	if(frm.hook_url.value == '' || !pattern.test(frm.hook_url.value)) {
		alert("<?php _e('Provide a valid Webhook URL', 'broadfast');?>");
		frm.hook_url.focus();
		return false;
	}
	
	return true;
}
</script>