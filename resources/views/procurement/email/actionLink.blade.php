<h1>Your Decision Pending</h1>

Dear {{$bodyDetails['userName']}},<br />
Yor Desc for {{$bodyDetails['document_name']}} id:{{$bodyDetails['document']}} {{$bodyDetails['doc_id']}} ,Dated:{{$bodyDetails['date']}} is pending
<br /><br />
please click the below link to make an action
<br />
<a href="{{ route('desc.pending.action', $bodyDetails['token']) }}">View Details</a>
<br /><br />
regards,
Qzole ERP System