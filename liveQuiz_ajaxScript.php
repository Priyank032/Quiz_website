<script type="text/javascript">
	
$(document).ready(function(){

	var quizDataArr=<?php echo json_encode($_SESSION['quizData']);?>;
	var qidsArr= <?php echo json_encode($_SESSION['qids']);?>;
	var q_index= <?php echo $_SESSION['q_index'];?>;
	var total_ques= <?php echo $_SESSION['total_ques'];?>;
	
	const nextPrevDisplay=(q_index)=>{
		if(q_index>0){
			$('#prevcontainer').css("display","block");
		}
		else{
			$('#prevcontainer').css("display","none");
		}
		if(q_index==total_ques-1){
			$('#nextcontainer').css("display","none");
		}
		else{
			$('#nextcontainer').css("display","block");	
		}
	}
	const checkRadio=(q_index)=>{
		$("input:radio[name='userSelectedOp']").prop('checked',false);
	let qid= qidsArr[q_index];
	let storedOp=quizDataArr[qid]['userOp'];
	$(`#radio_${storedOp}`).prop('checked',true);
	}
	const setQuestion=(q_index)=>{
		let qid= qidsArr[q_index];
		$('#ques_no').text(`Question no: ${q_index+1}`);
		$('input[name=q_index]').val(q_index);
		$('input[name=qid]').val(qid);
		let question= quizDataArr[qid]['question'].replace(/(\r\n|\n\r|\r|\n)/g, "<br>");
		question = question.replace(/(<<)/g,'&lt;&lt;');
		$('#question').html(question);
		$('#op1').text(quizDataArr[qid]['op1']);
		$('#op2').text(quizDataArr[qid]['op2']);
		$('#op3').text(quizDataArr[qid]['op3']);
		$('#op4').text(quizDataArr[qid]['op4']);
		checkRadio(q_index);
		nextPrevDisplay(q_index);
	}

	setQuestion(q_index);

	const AjaxScript=(URL,Q_index,command)=>{
		const formData=$('#questionForm').serialize();
		if(formData.includes('userSelectedOp')){
			const urlParams=new URLSearchParams(formData);
			const userOp=urlParams.get('userSelectedOp');
			const qid=urlParams.get('qid');
			if(quizDataArr[qid]['userOp']!=userOp){
				quizDataArr[qid]['userOp']=userOp;
				$.ajax({
	  				url : URL,
	  				type : 'post',
	  				data : formData,
	  				cache : false,
	  				async : false,
	  				success : function(updated_q_index){
	  					Q_index=parseInt(updated_q_index);
	  					setQuestion(Q_index);
	  				}
	  			});
			}
			else{
				if(command=='next'){
					Q_index++;
				}
				else{
					Q_index--;
				}
				setQuestion(Q_index);
			}
		}
		else{
			if(command=='next'){
				Q_index++;
			}
			else{
				Q_index--;
			}
			setQuestion(Q_index);
		}
		return Q_index;
	}
	
	$('#next').click(function(e){
		e.preventDefault();
		q_index=AjaxScript('next_q.php',q_index,'next');
	});

	$('#prev').click(function(e){
		e.preventDefault();
		q_index=AjaxScript('prev_q.php',q_index,'prev');
	});

});

</script>