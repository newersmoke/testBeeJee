<div class="alert alert-danger d-none" id="errorList">
    <label class="error"></label>
</div>
<table class="table  table-dark">
    <thead>
        <tr id="sortes">
            <td scope="col" class="sorted" name="userName">User Name</td>
            <td scope="col" class="sorted" name="userEmail">User Email</td>
            <td scope="col">Ticket</td>
            <td scope="col" class="sorted" name="status">Status</td>
            <?php if (System\Auth::isAuth()): ?>
                <td> Actions </td>
            <?php endif ?>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($tickets as $ticket): ?>
            <tr>
                <td><?php echo $ticket['userName'] ?></td>
                <td><?php echo $ticket['userEmail'] ?></td>
                <?php if (System\Auth::isAuth()): ?>
                    <td>

                        <form>
                            <input type="hidden" name="id" value="<?php echo $ticket['id'] ?>"/>
                            <div class='form-group'>
                                <input type="text" name="ticket" class='form-control' value="<?php echo htmlspecialchars($ticket['ticket']) ?>"/>
                            </div>

                            <button type="button" class="btn btn-primary savetext">Save</button>
                        </form>
                    </td>
                <?php else: ?>
                    <td><?php echo htmlspecialchars($ticket['ticket']) ?></td>
                <?php endif; ?>
                <td>
                    <?php echo $ticket['status'] ?> 
                    <?php if($ticket['edited'] == 1):?>
                       , edited by admin
                    <?php endif;?>
                </td>
                <?php if (System\Auth::isAuth()): ?>
                    <td> Done <input type="checkbox" class="setDone" id="<?php echo $ticket['id'] ?>"/> </td>
                <?php endif ?>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<form id="paginationForm">
    <input type="hidden" name="órder" value="<?php echo $orders['order'] ?>"/>
    <input type="hidden" name="order_by" value="<?php echo $orders['order_by'] ?>"/>
    <input type="hidden" name="page" value="<?php echo $orders['page'] ?>"/>
    <input type="hidden" name="per_page" value="<?php echo $orders['per_page'] ?>"/>
</form>

<?php if ($count > $defaultCount): ?>
    <nav aria-label="Page navigation example">
        <ul class="pagination">
            <?php for ($i = 1; $i <= ceil($count / $defaultCount); $i++): ?>
                <li class="page-item <?php if ($i == $orders['page']) {
            echo 'active';
        } ?>"><a class="page-link" href="#"  page="<?php echo $i; ?>"><?php echo $i; ?></a></li>
    <?php endfor; ?>
        </ul>
    </nav>
<?php endif; ?>