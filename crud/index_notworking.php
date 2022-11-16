<?
include 'config.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Try 3</title>
    <!-- <script type="text/javascript" src="jquery.min_.js"></script>
    <script type="text/javascript" src="jquery.dataTables.min_.js"></script>
    <link href="../link/dist/css/style.min.css" rel="stylesheet"> -->
    <link href="../link/style.min.css" rel="stylesheet">
    <!--only for indexpage-->



</head>

<body>
    <div class="container">
        <form id="form">
            <div class="form-group">
                <label>Name</label>
                <input type="text" name="name" id="name" placeholder="name" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Dob</label>
                <input type="date" name="dob" id="dob" placeholder="dob" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Des</label>
                <input type="text" name="des" id="des" placeholder="des" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Qua</label>
                <input type="text" name="qua" id="qua" placeholder="Qua" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" id="email" placeholder="Email" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Mobile</label>
                <input type="text" name="mo" id="mo" placeholder="Mobile" class="form-control" maxlength="10" required>
            </div>
            <div class="form-group">
                <label>Gender&emsp;&emsp;&emsp;</label>
                <input type="radio" name="gender" id="gender" value="male" class="form-check-input">Male&emsp;&emsp;&emsp;
                <input type="radio" name="gender" id="gender" value="female" class="form-check-input">Female&emsp;&emsp;&emsp;
            </div>
            <div class="form-group">
                <label>Is Relocate&emsp;&emsp;&emsp;</label>
                <input type="hidden" name="loc" id="loc" value="no" class="form-check-input">
                <input type="checkbox" name="loc" id="loc" value="yes" class="form-check-input">
            </div>
            <div class="form-group">
                <label>Country</label>
                <select name="country" id="country-dropdown" placeholder="country" class="form-control" required>
                    <option value="">Select Country</option>
                    <?
                    $sql = "Select * from countries";
                    $res = mysqli_query($conn, $sql);
                    while ($row = mysqli_fetch_array($res)) {
                    ?>
                        <option value="<? echo $row['id'] ?>"><? echo $row['name'] ?></option>
                    <? } ?>
                </select>
                <div class="form-group">
                    <label>State</label>
                    <select name="state" id="state-dropdown" class="form-control"></select>
                </div>
                <div class="form-group">
                    <label>City</label>
                    <select name="city" id="city-dropdown" class="form-control"></select>
                </div>
                <div>
                    <input type="hidden" name="id" id="id" value="0">
                    <button type="button" name="save" id="save" class="btn btn-primary">Save</button>
                    <button type="button" name="clear" id="clear" class="btn btn-primary">Clear</button>
                </div>
            </div>
        </form>

        <div class="container">
            <div class="row">
                <div class="card">
                    <div class="card-body">
                        <!-- <div class="table-responsive"> -->
                        <table id="zero_config" class="table table-striped table-bordered">

                            
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    
</body>

</html>

<script src="../link/jquery.min_.js"></script>
<script src="../link/perfect-scrollbar.jquery.min.js"></script>
<!-- <script src="../link/datatables.min.js"></script> -->
<script src="../link/datatable-basic.init.js"></script>
<script>
$(document).ready(function(){
    // $('#zero_config').DataTable({
    //     "processing": true,
    //     "serverSide": true,
    //     "ajax": "fetchData.php"
    // });

    let dt = $('#tab').DataTable({
        ajax: {
          url: 'fetchData.php'
          , dataSrc: '',
        }
        , columns: [
        { data: 'id', title: '#' }
        , { data: 'name', title: 'name' }
        , { data: 'dob', title: 'des' }
        , { data: 'qua', title: 'email' }
        , { data: 'mo', title: 'gender' }
        , { data: 'loc', title: 'country' }
        , { data: 'state', title: 'city' }
        , { data: 'id', title: 'edit', render: (d) => `
        
    <td><a href='#' class='btn btn-primary edit' id='{'id'}'>Edit</a></td>
    
        ` }
        ]
      });
});
</script>
<script>
    $(document).ready(function() {
        $("#clear").click(function() {
            $("#name").val("");
            $("#dob").val("");
            $("#des").val("");
            $("#qua").val("");
            $("input[name=gender]").prop('checked', false);
            $("#email").val("");
            $("input[name=loc]").prop('checked', false);
            $("#mo").val("");
            $("#country-dropdown").val("");
            $("#state-dropdown").val("");
            $("#city-dropdown").val("");
        });
        $("#save").click(function(e) {
            e.preventDefault();
            var btn = $(this);
            var id = $("#id").val();

            var required = true;

            $("#form").find('[required]').each(function() {
                if ($(this).val() == "") {
                    alert($(this).attr("placeholder"));
                    $(this).focus();
                    required = false;
                    return false;
                }
            })
            if (required) {
                $.ajax({
                    type: 'POST',
                    url: 'ajax_action.php',
                    data: $("#form").serialize(),
                    beforeSend: function() {
                        $(btn).text("Please Wait...");
                    },
                    success: function(res) {
                        var id = $("#id").val();
                        if (id == "0") {
                            $("#zero_config").find("tbody").append(res);
                        } else {
                            $("#zero_config").find("tbody").append(res);
                        }
                        $("#clear").click();
                        $("#save").text("add user");
                    }
                })
            }
        });
        $("body").on('click', '.delete', function(e) {
            e.preventDefault();
            var btn = $(this);
            var id = $(this).attr("id");
            if (confirm("Are you Sure?")) {
                $.ajax({
                    type: 'POST',
                    url: 'delete.php',
                    data: {
                        id: id
                    },
                    beforeSend: function() {
                        $(btn).text("Deleting...");
                    },
                    success: function() {
                        btn.closest("tr").remove();
                    }
                })
            }

        })
        $("body").on('click', '.edit', function(e) {
            e.preventDefault();
            var id = $(this).attr("id");
            $("#id").val(id);
            var row = $(this);
            var name = row.closest("tr").find("td:eq(0)").html();
            $("#name").val(name);
            var dob = row.closest("tr").find("td:eq(1)").html();
            $("#dob").val(dob);
            var des = row.closest("tr").find("td:eq(2)").html();
            $("#des").val(des);
            var qua = row.closest("tr").find("td:eq(3)").html();
            $("#qua").val(qua);
            var email = row.closest("tr").find("td:eq(4)").html();
            $("#email").val(email);
            var mo = row.closest("tr").find("td:eq(5)").html();
            $("#mo").val(mo);
            $('input[type=radio][name=gender][value=' + row.closest("tr").find("td:eq(6)").html() + ']').prop("checked", true);
            $('input[type=checkbox][name=loc][value=' + row.closest("tr").find("td:eq(7)").html() + ']').prop("checked", true);
            var country = row.closest("tr").find("td:eq(8)").html();
            $("#country-dropdown option").get().forEach(x => {
                if (x.label == country) {
                    x.selected = true;
                }
            });
            var state = row.closest("tr").find("td:eq(9)").html();
            var city = row.closest("tr").find("td:eq(10)").html();
            $("#country-dropdown").trigger('change', {
                state: state,
                city: city
            });
        })
    });
</script>
<script>
    $("#country-dropdown").on('change', function() {
        let args = arguments[1];
        var country_id = this.value;

        $.ajax({
            type: 'POST',
            url: 'state-by-country.php',
            data: {
                country_id: country_id
            },
            cache: false,
            success: function(res) {
                $("#state-dropdown").html(res);
                if (args) {
                    $("#state-dropdown option").get().forEach(x => {
                        if (x.label == args.state) {
                            x.selected = true;
                        }
                    })
                    if (args.city) {
                        $("#state-dropdown").trigger('change', {
                            city: args.city
                        })
                    }
                }
            }
        })
    });
    $("#state-dropdown").on('change', function() {
        let args = arguments[1];
        var state_id = this.value;

        $.ajax({
            type: 'POST',
            url: 'city-by-state.php',
            data: {
                state_id: state_id
            },
            cache: false,
            success: function(res) {
                $("#city-dropdown").html(res);
                $("#city-dropdown option").get().forEach(x => {
                    if (x.label == args.city) {
                        x.selected = true;
                    }
                })
            }
        })
    });
</script>