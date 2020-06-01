<%@taglib uri="http://java.sun.com/jsp/jstl/core" prefix="c" %>
<%@taglib uri="http://java.sun.com/jsp/jstl/sql" prefix="sql"%>
<c:if test="${element=='select'}">
  <div class="form-group"> 
		<label class="col-lg-2 col-sm-2 control-label" for="asunto">${label}</label>		
		<div class="col-lg-8">
			<select name="${nameSelect}" id="${nameSelect}" class="form-control" ${required}>
				<option value="">Seleccione</option>
				<c:if test="${not empty elementosSelect}">
					<c:forEach items="${elementosSelect}" var="item">
						<c:set var="selected" value=""></c:set>
						<c:if test="${not empty itemEdit}">
							<c:if test="${idEdit == item[nameIdList]}">
								<c:set var="selected" value="selected"></c:set>
							</c:if>
						</c:if>							
						<option value="${item[nameIdList]}" ${selected}>${item[nameCampList]}</option>
					</c:forEach>
				</c:if>
				<c:if test="${empty elementosSelect}" >
					<option value="">No hay registros disponibles</option>
				</c:if>					
			</select>
		</div>
	</div>
	<!--<c:remove var="elementosSelect"/>-->
</c:if>
<c:if test="${element=='campoTexto'}">
   <div class="form-group">
		<label class="col-lg-2 col-sm-2 control-label" for="asunto">${label}</label>
		<div class="col-lg-2 control-label" style="text-align:left">
			${valor}	
		</div> 
	</div>
</c:if>
<c:if test="${element=='fecha'}">
    <div class="form-group">
		<label class="col-lg-2 col-sm-2 control-label" for="asunto">${label}</label>				
		<div class="col-lg-8">
               <div class="input-group">
                <div class="input-group-addon">
                  <i class="fa fa-calendar"></i>
                </div> 
                	<input class="form-control pull-right" type="text" name="${nameCampo}" id="${nameCampo}" value="${valor}" onkeypress="return false;" ${required} autocomplete="off">
              </div>
		</div>
	 </div>
	 <script>
		$(document).ready(function() 
		{
			campoFecha("${nameCampo}");
		});
	</script>
</c:if>
<c:if test="${element=='fechainifechafin'}">
<style>
input[data-readonly] { pointer-events: none; } 
</style>
    <div class="form-group">
		<label class="col-lg-2 col-sm-2 control-label" for="asunto">${label1}</label>	
		<div class="col-lg-3">
		    <div class="input-group">
                <div class="input-group-addon">
                  <i class="fa fa-calendar"></i>
                </div>
                	<input type="text" id="${campo1}" name="${campo1}" class="form-control" value="${valor1}" readonly="readonly" ${required} autocomplete="off"></input>
            </div>				
		</div>
		<label class="col-lg-2 col-sm-2 control-label" for="asunto">${label2}</label>
		<div class="col-lg-3">
			<div class="input-group">
                <div class="input-group-addon">
                  <i class="fa fa-calendar"></i>
                </div>
                	<input type="text" id="${campo2}" name="${campo2}" class="form-control" value="${valor2}" readonly="readonly" onkeypress="return false;" ${required} autocomplete="off"></input>
            </div>				
		</div>
	 </div>
	 <script>
		$(document).ready(function() 
		{
			campoFecha("${campo1}");
			campoFecha("${campo2}");
		});
	</script>
</c:if>

<c:if test="${element=='autocomplete'}">
   <style> 
	 .ui-autocomplete-loading {
	  background: white url('img/input-spinner.gif') right center no-repeat;
	 }
	 .ui-widget {
		font-family: 'Source Sans Pro','Helvetica Neue',Helvetica,Arial,sans-serif;
		font-size: 1.1em;
	}
	</style>	
	<script>				
	$(function() 
	{
	      function log( message ) 
	      {
	       	$('#${nameCampo}').val(message);
	      }
	      $("#${nameCampo}_text").autocomplete
	      ({
	    	    source : function(request, response) {
	                $.ajax({
	                        url : "autocompleteInput",
	                        type : "POST",
	                        data :{term : request.term,tabla:"${tabla}",nombreId:"${nameId}",campo1:"${campo1}",campo2:"${campo2}",clausula:"${clausula}",valor:"${valor}",imprimir:"${imprimir}"},
	                        dataType : "json",
	                        success : function(data) {
	                           response(data);
	                        }
	                });
		        },
		        minLength: 1,
		        select: function( event, ui ) 
		        {
			        //console.log(ui);  
		        	log( ui.item ? ui.item.id :"Nothing selected, input was " + this.value );  
		        	$("#${nameCampo}_text").attr("readonly","readonly");
		        }
	      });
	 });  
	</script>
	<div class="form-group"> 
		<label class="col-lg-2 col-sm-2 control-label" for="asunto">${label}</label>
		<div class="col-lg-8">
		 <div class="input-group">
			<input type="hidden"  id="${nameCampo}" name="${nameCampo}" value="">
			<input type="text" ${required} id="${nameCampo}_text" name="${nameCampo}_text" class="form-control" placeholder="${label}" autocomplete="off">
		 	<span class="input-group-addon" title="Reiniciar campo"><a href="javascript:;" onclick='$("#${nameCampo}").val("");$("#${nameCampo}_text").val("");$("#${nameCampo}_text").removeAttr("readonly")'><i class="fa fa-fw fa-undo"></i></a></span>
		 </div>
		</div>
	</div>
	<c:if test="${not empty valor}">
	 <script>
	 $("#${nameCampo}_text").attr("readonly","readonly");
	 $.ajax({
         url : "autocompleteInput",
         type : "GET",
         data :{tabla:"${tabla}",nombreId:"${nameId}",campo:"${campo1}",id:"${valor}"},
         dataType : "json",
         success : function(data) {
             //console.log(data);
             $("#${nameCampo}").val(data[0].id);
             $("#${nameCampo}_text").val(data[0].value);
         }
 		});
	 </script>
	</c:if>
</c:if>
 
<c:if test="${element=='spinnerCentrado'}">
   <script>
	function cargarSpinner() 
	{
		if(!(document.getElementById("${idFile}").value)=="") 
		{
	        if("${confirm}"=="1")
	        {
	        	if(confirm("${mensajeConfirm}"))
	        	{
	        		$("#${id}").css("display","block"); 
			        $("#${idButton}").attr("disabled","disabled");
			        $("form[name*='${nameForm}']").submit();
	        	}
	        }
	        else 
	        {
	        	$("#${id}").css("display","block"); 
		        $("#${idButton}").attr("disabled","disabled");
		        if("${confirm}"=="1")
		        {
		        	$("#${idForm}").submit();
		        }
	        }
	    }
		else
		{
			if("${confirm}"=="1")
	        {
				alert("Por favor seleccione el archivo");
	        }
		}
	}
	$("#${idButton}").click(function(event)
	{
		if("${confirm}"=="1")
	    {
			event.preventDefault();
	    }
		cargarSpinner()
	});
	</script>	
   <div class="divCentrado" id="divCentrado" style="display: none"> 
		<img src="${path}/img/input-spinner.gif"> 
   </div>
</c:if>

<c:remove var="element"/>