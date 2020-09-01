

<div class="inputs">
    <div class="input">
        <label for="name">Name:</label>
        <input 
        type="text" 
        placeholder="Contact Name" 
        id="name"
        value="<?php echo (isset($contact['name'])) ? $contact['name'] : ''; ?>"
        >

    </div>
    <div class="input">
        <label for="company">Company:</label>
        <input 
        type="text" 
        placeholder="Company Name" 
        id="company"
        value="<?php echo(isset($contact['company'])) ? $contact['company']  : ''; ?>"
        >
    </div>
    <div class="input">
        <label for="phone">Phone:</label>
        <input 
        type="tel" 
        placeholder="Contact Phone" 
        id="phone"
        value="<?php echo(isset($contact['phone'])) ? $contact['phone'] : ''; ?>"
        >
    </div>
</div>
<div class="input send">
    <?php
    $textButton = (isset($contact['phone'])) ? 'Save' : 'Add';
    $action = (isset($contact['phone'])) ? 'update' : 'create';
    ?>
    <input type="hidden" id="action" value="<?php echo $action?>">
    <?php if(isset($contact['id'])){ ?>
        <input type="hidden" id="id" value="<?php echo $contact['id'];?>">
     <?php } ?>
    <input type="submit" value="<?php echo $textButton?>">
</div>