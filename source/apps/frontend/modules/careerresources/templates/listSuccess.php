<?php
// auto-generated by sfPropelCrud
// date: 2009/07/17 06:53:33
?>
<h1>careerresources</h1>

<table>
<thead>
<tr>
  <th>Id</th>
  <th>Name</th>
</tr>
</thead>
<tbody>
<?php foreach ($careerresourcess as $careerresources): ?>
<tr>
    <td><?php echo link_to($careerresources->getId(), 'careerresources/show?id='.$careerresources->getId()) ?></td>
      <td><?php echo $careerresources->getName() ?></td>
  </tr>
<?php endforeach; ?>
</tbody>
</table>

<?php echo link_to ('create', 'careerresources/create') ?>