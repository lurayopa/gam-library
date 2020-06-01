//Funciones de paginacion
var controllerLocal;
function mostrarPaginador(id,pag,filtro,controller)   
{		
	$('#cargar').css('display','block');
	var num_rows=$("#numRows").val();
	if (num_rows === undefined) 
	{
		num_rows=10;
	}
	if(pag!=null)
	{
		pag=pag
	}
	else
	{
		pag=1;
	}
	if(filtro==null)
	{
		filtro="null";
	}
	if(controller!=null)
	{
		controllerLocal=controller;
	}
	$.ajax
	({
		data:
		{ 
		 'pag':pag,
		 'num_rows':num_rows,
		 'filtro':filtro			  
		},
		url:controllerLocal,
		type:'POST',
		beforeSend: function(value)
		{				
			var $img  = eval("$('div#cargar').html('<div class=\"position-center\"><label class=\"col-lg-2 col-lg-2 control-label\" for=\"asunto\">&nbsp;</label><div class=\"col-md-12\"><img src=\"..../../img/input-spinner.gif\" /></div></div>')");
		},
		success: function (usuarios)
		{
			$('div #cargar').html(usuarios);			
		} 			
	});				
}
//PAGINADOR 
function paginar(actual, total, por_pagina, maxpags, pagini, pagfin) 
{	
	//console.log(actual+"-"+total+"-"+por_pagina+"-"+maxpags+"-"+pagini+"-"+pagfin);
	
	//*1 Para parsear a Entero
	actual=actual*1;
	total=total*1;
	por_pagina=por_pagina*1;
	maxpags=maxpags*1;
	pagini=pagini*1;
	var  texto = '<div id="navePage" class="pagination"><ul>';	  
	var total_paginas = Math.ceil(total/por_pagina);
	pagfin=total_paginas;
	var anterior = actual - 1;
	var posterior = actual + 1;
	var med = maxpags/2;
	var minimo = 0; 
	
	if( (actual + med) >= total_paginas) //(1+5)>=11
	{
		minimo = Math.max(total_paginas - maxpags + 1,1);
	}
	else 
	{
		minimo = ( (actual-med)>0 )? actual - med : 1; //( (1-5) )
	}
	var maximo = 0;  
	if (actual>1) 
	{						
		texto += '<li><a href="javascript:;" onclick="pagina(' + pagini + ')" title="Inicio">Primero</a></li>';
		texto += '<li><a href="javascript:;" onclick="pagina(' + anterior + ')" title="Back">&larr; Atras</a></li>';
	}
	maximo = Math.min(minimo + maxpags - 1, total_paginas);
	for (var i=minimo; i <= maximo; i++)
	{
		if(i == actual) 
		{
		  texto += '<li class="active"><a><b>' + actual + "</b></a></li>";
		}
		else 
		{
		  texto += '<li><a href="javascript:;" onclick="pagina('+ i + ')" >' + i + '</a></li>';
		}
	}
	if (actual < total_paginas )
	{
		texto += '<li><a href="javascript:;" onclick="pagina('  + posterior + ')" title="Next">Siguiente &rarr;</a></li>';
		texto += '<li><a href="javascript:;" onclick="pagina('  + pagfin + ')" title="Final">Ultimo</a></li>';
	}
	texto += '</ul></div>';
	return texto;
}
//fin de paginador 