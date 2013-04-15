<div class="grid_4">
	<p>|</p>
</div>


<div class="grid_12">
<P>REGIAO META FEITA % FALTA</P>
<p>NORTE | <?php echo $meta_norte->metas_valor; ?> | <?php echo $norte->total; ?> | <?php echo (100 * $norte->total) / $meta_norte->metas_valor. '%'; ?> | <?php echo $meta_norte->metas_valor - $norte->total; ?></p>
<p>NORDESTE | <?php echo $meta_nordeste->metas_valor; ?> | <?php echo $nordeste->total; ?> | <?php echo (100 * $nordeste->total) / $meta_nordeste->metas_valor. '%'; ?> | <?php echo $meta_nordeste->metas_valor - $nordeste->total; ?></p>
<p>CENTRO-OESTE | <?php echo $meta_centro_oeste->metas_valor; ?> | <?php echo $centro_oeste->total; ?> | <?php echo (100 * $centro_oeste->total) / $meta_centro_oeste->metas_valor. '%'; ?> | <?php echo $meta_centro_oeste->metas_valor - $sul->total; ?></p>
<p>SUDESTE | <?php echo $meta_sudeste->metas_valor; ?> | <?php echo $sudeste->total; ?> | <?php echo (100 * $sudeste->total) / $meta_sudeste->metas_valor. '%'; ?> | <?php echo $meta_sudeste->metas_valor - $sudeste->total; ?></p>
<p>SUL | <?php echo $meta_sul->metas_valor; ?> | <?php echo $sul->total; ?> | <?php echo (100 * $sul->total) / $meta_sul->metas_valor. '%'; ?> | <?php echo $meta_sul->metas_valor - $sul->total; ?></p>
</div>