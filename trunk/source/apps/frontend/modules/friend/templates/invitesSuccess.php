<?php
	include_component('home', 'leftmenu');
	include_component('home', 'messages');
?>
<?php echo $type; ?>
<div class="page">
	<h3>Friend Inites for You</h3>
	<div class="vspacer20">&nbsp;</div>
	<?php $flag=1; ?>
	<?php foreach ($pager->getResults() as $friendobj): ?>
		<?php $flag = 0; ?>
	<div class="flbox">
		<div class="flimage"><img src="<?php echo $friendobj->getUser()->getPersonal()->getImage() ?>" alt="friend picture"></div>
		<div class="fldetail"><b><?php echo $friendobj->getUser()->getFullname() ?></b></div>
		<div class="fldetail"><?php echo "Degree :".$friendobj->getUser()->getDegree()->getName() ?></div>
		<div class="fldetail"><?php echo "Branch :".$friendobj->getUser()->getBranch()->getName() ?></div>
		<div class="fldetail"><?php echo "Year :".$friendobj->getUser()->getGraduationyear() ?></div>
		<div class="fldel">
			<a href="/friend/approve/id/<?php echo $friendobj->getUserId() ?>.html"><img src="/images/yes.png" alt="Approve request" title="Approve friend Request"></a>
			<br><br><br><br><br><br>
			<a href="/friend/reject/id/<?php echo $friendobj->getUserId() ?>.html"><img src="/images/no.png" alt="Reject request" title="Reject friend Request"></a>
		</div>
	</div>
	<?php endforeach; ?>
	<div class="centermsg"><?if($flag): echo "No invites for you !!"; endif; ?></div>
	<div id="pager">
		<?php if ($pager->haveToPaginate()): ?>
			<?php echo link_to('<img src="/images/first.png"/>', 'friend/myfriends?page=1') ?>
			<?php echo link_to('<img src="/images/prev.png"/>', 'friend/myfriends?page='.$pager->getPreviousPage()) ?>
			<?php foreach ($pager->getLinks() as $page): ?>
				<b><?php echo link_to_unless($page == $pager->getPage(), $page, 'friend/myfriends?page='.$page,'class="pageno"') ?></b>
				<?php echo ($page != $pager->getCurrentMaxLink()) ? '&nbsp;' : '' ?> 
			<?php endforeach; ?>
			<?php echo link_to('<img src="/images/next.png"/>', 'friend/myfriends?page='.$pager->getNextPage()) ?>
			<?php echo link_to('<img src="/images/last.png"/>', 'friend/myfriends?page='.$pager->getLastPage()) ?>
		<?php endif; ?>
	</div>
</div>