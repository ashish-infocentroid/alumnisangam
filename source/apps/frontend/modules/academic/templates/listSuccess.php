<?php include_component('home','leftmenu'); ?>

<?php
// auto-generated by sfPropelCrud
// date: 2009/02/10 08:17:12
?>
<h1>academic</h1>

<table>
<thead>
<tr>
  <th>Id</th>
  <th>User</th>
  <th>Degree</th>
  <th>Degreeflag</th>
  <th>Year</th>
  <th>Yearflag</th>
  <th>Department</th>
  <th>Departmentflag</th>
  <th>Major</th>
  <th>Majorflag</th>
  <th>Institute</th>
  <th>Instituteflag</th>
</tr>
</thead>
<tbody>
<?php foreach ($academics as $academic): ?>
<tr>
    <td><?php echo link_to($academic->getId(), 'academic/show?id='.$academic->getId()) ?></td>
      <td><?php echo $academic->getUserId() ?></td>
      <td><?php echo $academic->getDegree() ?></td>
      <td><?php echo $academic->getDegreeflag() ?></td>
      <td><?php echo $academic->getYear() ?></td>
      <td><?php echo $academic->getYearflag() ?></td>
      <td><?php echo $academic->getDepartment() ?></td>
      <td><?php echo $academic->getDepartmentflag() ?></td>
      <td><?php echo $academic->getMajor() ?></td>
      <td><?php echo $academic->getMajorflag() ?></td>
      <td><?php echo $academic->getInstitute() ?></td>
      <td><?php echo $academic->getInstituteflag() ?></td>
  </tr>
<?php endforeach; ?>
</tbody>
</table>

<?php echo link_to ('create', 'academic/create') ?>