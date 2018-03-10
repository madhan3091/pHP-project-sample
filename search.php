<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Tag Search</title>

        <!-- Bootstrap -->
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">

        <!-- fonts -->
        <link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

        <!-- CSS STYLE-->
        <link rel="stylesheet" type="text/css" href="../css/style.css" media="screen" />
        <link href="../css/custom.css" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="../css/surveylist.css" media="screen" />
        <link rel="stylesheet" type="text/css" href="../css/settings.css" media="screen" />
                <!--Javascript -->
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
     <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> 
    </head>
    <body>  

<div class="container-fluid">
<!--Header-->
<% var page  = 'surveylist'; %>
<%- include includes/header.ejs %>
<!--End Header-->
<div class="clearfix"></div>
 <section class="content">
  <div class="container">
         <div class="row">

             <%- include includes/left-sidebar.ejs %>
             <div class="col-lg-6 col-md-6">
               <!---Alerts-->
                <%- include includes/alerts.ejs %>
                <!---End Alerts-->
                <div class="clearfix"></div>
                <div class="col-sm-12 search_result_div">Search By <%= search_type %> : <%= search_query %></div>
                 <div class="clearfix"></div>
             <!--Survey List-->
               <% var surveyList  = surveys; %>
               <%- include includes/surveylist.ejs %>
            <!--End Survey List-->
            <!--pagination-->
            <% if (pages > 0) { %>
                <ul class="pagination text-center">
                    <% if (current_page == 1) { %>
                        <li class="disabled"><a>First</a></li>
                    <% } else { %>
                        <li><a href="/tags/<%= search_query %>?p=1">First</a></li>
                    <% } %>
                    <% var i = (Number(current_page) > 5 ? Number(current_page) - 4 : 1) %>
                    <% if (i !== 1) { %>
                        <li class="disabled"><a>...</a></li>
                    <% } %>
                    <% for (; i <= (Number(current_page) + 4) && i <= pages; i++) { %>
                        <% if (i == current_page) { %>
                            <li class="active"><a><%= i %></a></li>
                        <% } else { %>
                            <li><a href="/tags/<%= search_query %>?p=<%= i %>"><%= i %></a></li>
                        <% } %>
                        <% if (i == Number(current_page) + 4 && i < pages) { %>
                            <li class="disabled"><a>...</a></li>
                        <% } %>
                    <% } %>
                    <% if (current_page == pages) { %>
                        <li class="disabled"><a>Last</a></li>
                    <% } else { %>
                        <li><a href="/tags/<%= search_query %>?p=<%= i-1 %>">Last</a></li>
                    <% } %>
                </ul>
            <% } %>
            <!--End Pagination-->
             </div>
                <%- include includes/right-sidebar.ejs %>    
            </div>
  </div>
 </section>
 
<!--Footer-->
<%- include includes/footer.ejs %>
<!--End Footer-->
</div><!--Container-->
    </body>

</html>