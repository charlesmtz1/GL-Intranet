$(document).ready(function() {
    $('#inventarioForm').bootstrapValidator({
	 feedbackIcons: {
		 valid: 'glyphicon glyphicon-ok',
		 invalid: 'glyphicon glyphicon-remove',
		 validating: 'glyphicon glyphicon-refresh'
	 },
 
	 fields: {
		 nombre: {
			 validators: {
				 notEmpty: {
					 message: 'El nombre es requerido'
				 },
                 regexp: {
                     message: 'El campo sólo debe contener letras'
                 }
			 }
		 },
 
		 domicilio: {
			 validators: {
				 notEmpty: {
					 message: 'El domicilio es requerido'
				 }
			 }
		 },

         municipio: {
			 validators: {
				 notEmpty: {
					 message: 'El municipio es requerido'
				 }
			 }
		 },

         telefono: {
			 message: 'El teléfono no es valido',
			 validators: {
				 notEmpty: {
					 message: 'El teléfono no puede estar vacio'
				 },
				 regexp: {
					 message: 'El teléfono solo puede contener números'
				 }
			 }
		 },

         celular: {
			 message: 'El teléfono no es valido',
			 validators: {
				 notEmpty: {
					 message: 'El teléfono no puede estar vacio'
				 },
				 regexp: {
					 message: 'El teléfono solo puede contener números'
				 }
			 }
		 },

		 email: {
			 validators: {
				 notEmpty: {
					 message: 'El correo es requerido y no puede estar vacio'
				 },
				 emailAddress: {
					 message: 'El correo electronico no es valido'
				 }
			 }
		 },

         marca: {
			 validators: {
				 notEmpty: {
					 message: 'La marca es requerida'
				 },
                 regexp: {
                     message: 'El campo sólo debe contener letras'
                 }
			 }
		 },

         tipo: {
			 validators: {
				 notEmpty: {
					 message: 'El tipo es requerido'
				 }
			 }
		 },

         modelo: {
			 message: 'El modelo no es valido',
			 validators: {
				 notEmpty: {
					 message: 'El modelo no puede estar vacio'
				 },
				 regexp: {
					 message: 'El modelo solo puede contener números'
				 }
			 }
		 },

         placas: {
             message: 'Las placas no son validas',
			 validators: {
				 notEmpty: {
					 message: 'Las placas son requeridas'
				 }
			 }
		 },

         cia: {
			 validators: {
				 notEmpty: {
					 message: 'La compañia es requerida'
				 },
                 regexp: {
                     message: 'El campo sólo debe contener letras'
                 }
			 }
		 },

         siniestro: {
			 validators: {
				 notEmpty: {
					 message: 'El siniestro es requerido'
				 }
			 }
		 },

         color: {
			 validators: {
				 notEmpty: {
					 message: 'El color es requerido'
				 },
                 regexp: {
                     message: 'El campo sólo debe contener letras'
                 }
			 }
		 },

         puertas: {
			 message: 'El valor no es valido',
			 validators: {
				 notEmpty: {
					 message: 'Especifique el número de puertas'
				 },
				 regexp: {
					 message: 'El campo solo puede contener números'
				 }
			 }
		 },

         fecha: {
			 validators: {
				 notEmpty: {
					 message: 'La fecha de ingreso es requerida'
				 }
			 }
		 },

         kilometros: {
			 validators: {
				 notEmpty: {
					 message: 'Especifique los kilometros'
				 },
				 regexp: {
					 message: 'El campo solo puede contener números'
				 }
			 }
		 },

         gasolina: {
			 validators: {
				 notEmpty: {
					 message: 'Especifique la gasolina'
				 }
			 }
		 },

	 }
});
});