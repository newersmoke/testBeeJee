<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link href="https://cdn.jsdelivr.net/npm/docsearch.js@2/dist/cdn/docsearch.min.css" rel="stylesheet">
        <title>Test</title>
        <style>
            .navbar-default {
                background-color: #ffc107;
                border-color: #ffc107;
            }
        </style>
    </head>
    <body>
        <nav class="navbar navbar-default">

            <?php if (!System\Auth::isAuth()): ?>
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#LoginModal">Login</button>
                <?php else: ?>
                <a href="/auth/logout" class="btn btn-primary"> Logout <a>
            <?php endif; ?>

            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#AddTicket">Add Ticket</button>
        </nav>

                    <!-- Optional JavaScript -->
                    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
                    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
                    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
                    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
                    <script src="https://code.jquery.com/jquery-3.2.1.min.js" crossorigin="anonymous"></script>

                    <div id="listTickets">
                    </div>
                    
                    
                    <!-- Modal Login-->
                    <div class="modal fade" id="LoginModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Login</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form id="form" role="form">
                                    <div class="modal-body">
                                        <div class="alert alert-danger d-none" id="loginError">
                                            <label class="error"></label>
                                        </div>
                                        <div class='form-group'>
                                            <label for="login">Login:</label> <input type="text" name="login" class='form-control'/>
                                        </div>
                                        <div class='form-group'>
                                            <label for="password">Password:</label> <input type="password" name="password" class='form-control'/>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="button" class="btn btn-primary" id="loginSubmit">Login</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    
                    
                        <!-- Modal Edit-->
                    <div class="modal fade" id="AddTicket" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Tickets</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form id="form" role="form">
                                    <div class="modal-body">
                                        <div class="alert alert-danger d-none" id="ticketError">
                                            <label class="error"></label>
                                        </div>
                                        <div class='form-group'>
                                            <label for="login">User Name:</label> <input type="text" name="userName" class='form-control'/>
                                        </div>
                                        <div class='form-group'>
                                            <label for="userEmail">User Email:</label> <input type="text" name="userEmail" class='form-control'/>
                                        </div>
                                        <div class='form-group'>
                                            <label for="ticket">Ticket:</label> <input type="text" name="ticket" class='form-control'/>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal" id="closeTicket">Close</button>
                                        <button type="button" class="btn btn-primary" id="ticketSubmit">Create</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                     
                    
                    
                    <script>
                        function loadList(){
                            $.ajax({
                                type: 'POST',
                                url: '/ticket/list',
                                data: $('#paginationForm').serialize()
                            }).done((response) => {
                                $('#listTickets').html(response);
                            });
                        }
                        
                        $(document).on('click', '.pagination a' , function() {
                            $('.pagination li').removeClass('active');
                            $(this).parents('li').addClass('active');
                            $('#paginationForm input[name="page"]').val($(this).attr('page'));
                            loadList();
                        });
                        
                        $(document).on('click' , '#sortes .sorted' , function(){
                            let order = $(this).attr('name'),
                                orderBy = $('#paginationForm input[name="order_by"]').val();
                            $('#paginationForm input[name="órder"]').val(order);
                            $('#paginationForm input[name="order_by"]').val(orderBy == 'ASC' ? 'DESC' : 'ASC');
                            loadList();
                        });
                        
                        $(document).on('click' , '.savetext' , function(){
                            $.ajax({
                                type: 'POST',
                                url: '/ticket/edit',
                                data: $(this).parents('form').serialize()
                            }).done( (response) => {
                                let data = JSON.parse(response);
                                let errorBlock = $('#errorList');
                                if (data && data.error) {
                                    errorBlock.removeClass('d-none');
                                    errorBlock.find('label.error').text(data.message);

                                    return false;
                                }
                                errorBlock.addClass('d-none');
                                loadList();
                            });
                        });
                        
                        $(document).on('click' , '.setDone' , function(){
                            $.ajax({
                                type: 'POST',
                                url: '/ticket/done',
                                data: {id : $(this).attr('id')}
                            }).done( (response) => {
                                let data = JSON.parse(response);
                                let errorBlock = $('#errorList');
                                if (data && data.error) {
                                    errorBlock.removeClass('d-none');
                                    errorBlock.find('label.error').text(data.message);

                                    return false;
                                }
                                errorBlock.addClass('d-none');
                                loadList();
                            });
                        });
                        
                        $('#loginSubmit').on('click', function () {
                            const errorBlock = $('#loginError');
                            const form = $(this).parents('form');
                            $.ajax({
                                type: 'POST',
                                url: '/auth/signin',
                                data: form.serialize()
                            }).done( (response) => {
                                let data = JSON.parse(response);

                                if (data && data.error) {
                                    errorBlock.removeClass('d-none');
                                    errorBlock.find('label.error').text(data.message);

                                    return false;
                                }


                                document.location.href = document.location.href;

                            });
                        })
                        $('#ticketSubmit').on('click', function () {
                            const errorBlock = $('#ticketError');
                            const form = $(this).parents('form');
                            $.ajax({
                                type: 'POST',
                                url: '/ticket/create',
                                data: form.serialize()
                            }).done( (response) => {
                                let data = JSON.parse(response);

                                if (data && data.error) {
                                    errorBlock.removeClass('d-none');
                                    errorBlock.find('label.error').text(data.message);

                                    return false;
                                }

                                $('#closeTicket').click();
                                loadList();
                            });
                        })
                        
                        loadList();
                    </script>

                    </body>
                    </html>