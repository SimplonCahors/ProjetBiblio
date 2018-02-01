<h1>LWS Affiliation</h1>
<?php if (isset($formError)) : ?>
<div class="error">
    <p><?php echo $formError ?></p>
</div>
<?php endif ?>
<?php if (isset($formSuccess)) : ?>
<div class="updated">
    <p>Votre identifiant a bien été enregistré.</p>
</div>
<?php endif ?>
<p>
    Indiquez ici votre identifiant d'affilié LWS, il s'agit du login à l'aide du quel vous accèdez au panel d'<a href="https://affiliation.lws-hosting.com" target="_blank">affiliation</a> LWS.<br/>
     Si vous n'avez pas de compte affilié LWS, vous pouvez en créer un en quelques minutes depuis la <a href="https://affiliation.lws-hosting.com/members/addmember" target="__blank" title="Inscription Affiliation LWS">page d'inscription</a>.
</p>
<form method="post">
    <div class="tagsdiv">
        <input type="text" name="username-aff-lws" value="<?php if (isset($configLWS['username'])) : ?><?php echo $configLWS['username'] ?><?php endif ?>" placeholder="Votre identifiant affilié" class="newtag form-input-tip"/>
        <input type="submit" name="validate-config-aff-lws" id="publish" class="button button-primary" value="Valider" />
    </div>
</form>
<p>
   
</p>
