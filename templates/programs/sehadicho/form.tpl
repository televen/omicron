<div class="shd-form shd">
	<div class="form_wrapper one">
		<form class="form-horizontal" id="step-one">
			<div class="demandant_info">
				<div class="title">Perfil del demandante</div>
				<div class="control-group">
					<label for="name" class="control-label">Nombre:</label>
					<div class="controls">
						<input type="text" name="name" id="name"  data-optional="false"/><span class="help-inline">* Tu nombre</span>
					</div>
				</div>
				<div class="control-group">
					<label for="last-name" class="control-label">Apellido:</label>
					<div class="controls">
						<input type="text" name="last-name" id="last-name"  data-optional="false"/><span class="help-inline">* Tu apellido</span>
					</div>
				</div>
				<div class="control-group">
					<label for="email" class="control-label">Email:</label>
					<div class="controls">
						<input type="text" name="email" id="email"  data-optional="false"/><span class="help-inline">* Te contactaremos por esta v&iacute;a</span>
					</div>
				</div>
				<div class="control-group">
					<label for="phone" class="control-label">Tel&eacute;fono:</label>
					<div class="controls">
						<input type="text" name="phone" id="phone" data-optional="true"/><span class="help-inline">Opcional</span>
					</div>
				</div>
				<span class="help-inline">(*) Campos requeridos</span>
				<a href="" class="btn btn-warning send-form" id="step-one-btn" data-form="step-one" data-step="two">Siguiente</a>
			</div>
		</form>
	</div>
	<div class="form_wrapper two">
		<form class="form-horizontal" id="step-two">
			<div class="defendant_info">
				<div class="title">Perfil del demandado</div>
				<div class="control-group">
					<label for="name" class="control-label">Nombre:</label>
					<div class="controls">
						<input type="text" name="name" id="name"  data-optional="false"/><span class="help-inline">* Nombre del demandado</span>
					</div>
				</div>
				<div class="control-group">
					<label for="last-name" class="control-label">Apellido:</label>
					<div class="controls">
						<input type="text" name="last-name" id="last-name"  data-optional="false"/><span class="help-inline">* Apellido del demandado</span>
					</div>
				</div>
				<div class="control-group">
					<label for="email" class="control-label">Email:</label>
					<div class="controls">
						<input type="text" name="email" id="email"  data-optional="false"/><span class="help-inline">* Lo contactaremos por esta v&iacute;a</span>
					</div>
				</div>
				<div class="control-group">
					<label for="phone" class="control-label">Tel&eacute;fono:</label>
					<div class="controls">
						<input type="text" name="phone" id="phone"  data-optional="true"/><span class="help-inline">Opcional</span>
					</div>
				</div>
				<span class="help-inline">(*) Campos requeridos</span>
				<a href="" class="btn btn-warning send-form" id="step-two-btn" data-form="step-two" data-step="three">Siguiente</a>
			</div>
		</form>
	</div>
	<div class="form_wrapper three">
		<form class="form-horizontal" id="step-three">
			<div class="case_info">
				<div class="title">Descripci&oacute;n del caso</div>
				<div class="control-group"><div class="controls"><label for="case">Caso:</label><textarea name="case" id="case"  data-optional="false" ></textarea></div></div>
				<span class="help-inline">(*) Campos requeridos</span>
				<a href="" class="btn btn-warning send-form" id="step-four-btn" data-form="step-three" data-step="four">Finalizar</a>
			</div>
		</form>
	</div>
	<div class="form_wrapper four">
		<form class="form-horizontal" id="step-four">
			Enviando datos
		</form>
	</div>
</div>