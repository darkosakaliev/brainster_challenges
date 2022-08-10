<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100">
        @include('layouts.navigation')

        <!-- Page Content -->
        <main>
            {{ $slot }}
        </main>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(function() {
            $.ajax({
                type: "GET",
                url: "/api/users",
                success: function(response) {
                    renderTableBody(response)
                }
            });

            $(document).on('click', '.delete', function(e) {
                let userId = $(this).data('id')

                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            type: "DELETE",
                            url: "/api/users/" + userId,
                            success: function(response) {
                                $(`#${userId}`).remove()
                            }
                        });
                        Swal.fire(
                            'Deleted!',
                            'The user has been deleted.',
                            'success'
                        )
                    }
                })
            })

            $(document).on('click', '.activate', function(e) {
                let userId = $(this).data('id')

                Swal.fire({
                    title: 'Are you sure you want to activate this user?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, please!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            type: "PUT",
                            url: "/api/users/" + userId + "/activate",
                            success: function(response) {
                                $(`#${userId} .active-status`).html(
                                    '<svg class="w-5 h-5 text-green-500" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path></svg>'
                                )
                                $(`#${userId} .activate`).replaceWith(
                                    `<button data-id="${userId}" class="bg-red-500 text-white px-3 py-1 rounded-full deactivate">Deactivate</button>`
                                )
                            }
                        });
                        Swal.fire(
                            'Activated!',
                            'The user has been activated.',
                            'success'
                        )
                    }
                })
            })

            $(document).on('click', '.deactivate', function(e) {
                let userId = $(this).data('id')

                Swal.fire({
                    title: 'Are you sure you want to deactivate this user?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, please!'
                }).then((result) => {

                    if (result.isConfirmed) {
                        $.ajax({
                            type: "PUT",
                            url: "/api/users/" + userId + "/deactivate",
                            success: function(response) {
                                $(`#${userId} .active-status`).html(
                                    '<svg class="w-5 h-5 text-red-500" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>'
                                )
                                $(`#${userId} .deactivate`).replaceWith(
                                    `<button data-id="${userId}" class="bg-green-500 text-white px-3 py-1 rounded-full activate">Activate</button>`
                                )
                            }
                        });
                        Swal.fire(
                            'Deactivated!',
                            'The user has been deactivated.',
                            'success'
                        )
                    }
                })
            })

            $("#btn-add").click(function() {
                $("#btn-save").val("add");
                $("#myForm").trigger("reset");
                $("#formModal").modal("show");
            });

            $("#btn-save").on("click", function(e) {
                e.preventDefault();
                var formData = {
                    name: $("#name").val(),
                    email: $("#email").val(),
                    password: $("#password").val(),
                    password_confirmation: $("#password_confirmation").val(),
                };
                $.ajax({
                    type: "POST",
                    url: "/api/users",
                    data: formData,
                    dataType: "json",
                    success: function(response) {
                        var user =
                        `
                        <tr id="${response.id}" class="bg-white border-b">
                            <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap">${response.name}</th>
                            <td class="py-4 px-6">${response.email}</td>
                            <td class="py-4 px-6 active-status"><svg class="w-5 h-5 text-red-500" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg></td>
                            <td class="py-4 px-6">
                                <button data-id="${response.id}" class="bg-green-500 text-white px-3 py-1 rounded-full activate">Activate</button>
                                <button data-id="${response.id}" class="bg-red-500 text-white px-3 py-1 rounded-full delete">Delete</button>
                            </td>
                        </tr>
                        `;

                        $("#userTable").append(user);
                        $("#myForm").trigger("reset");
                        $("#formModal").modal("hide");
                        Swal.fire(
                            "Registered successfully!",
                            "The User has been registered.",
                            "success"
                        );
                    },
                    error: function(data) {
                        console.log(data);
                    },
                });


            });

            function renderTableBody(users) {
                let tbody = ''

                users.forEach(user => {
                    let actions = ''

                    if (user.is_active == 1) {
                        user.is_active =
                            '<svg class="w-5 h-5 text-green-500" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path></svg>'
                        actions +=
                            `
                        <button data-id="${user.id}" class="bg-red-500 text-white px-3 py-1 rounded-full deactivate">Deactivate</button>
                        `
                    } else {
                        user.is_active =
                            '<svg class="w-5 h-5 text-red-500" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>'
                        actions +=
                            `
                        <button data-id="${user.id}" class="bg-green-500 text-white px-3 py-1 rounded-full activate">Activate</button>
                        `
                    }

                    actions +=
                        `<button data-id="${user.id}" class="bg-red-500 text-white px-3 py-1 rounded-full delete">Delete</button>`

                    tbody += `
                        <tr id="${user.id}" class="bg-white border-b">
                            <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap">${user.name}</th>
                            <td class="py-4 px-6">${user.email}</td>
                            <td class="py-4 px-6 active-status">${user.is_active}</td>
                            <td class="py-4 px-6">${actions}</td>
                        </tr>
                        `
                });

                $('#userTable').html(tbody)
            }
        });
    </script>
</body>

</html>
