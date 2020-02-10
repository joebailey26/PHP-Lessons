<?php include("functions.php"); ?>
<!DOCTYPE html>
<html>
    <head>
        <title>HitTastic!</title>
    </head>
    <body>
        <h1>HitTastic!</h1>
        <p>Search and download your favorite 40 hits on
        HitTastic! Whether it's pop, rock, rap, or pure liquid
        cheese you're into, you can be sure to find it on
        HitTastic! With the full range of top 40 hits from the
        past 60 years on our database, you can guarantee you'll
        find what you're looking for. Plus with our Year Search
        (coming soon!) find out exactly what was in the chart in
        any year in the past 60 years. </p>
        <form method="post" action="search_results.php">
            <fieldset>
                <label>Please enter an artist:</label>
                <input name="theArtist" required />
                <input type="submit" value="Go!" />
            </fieldset>
        </form>
        <?php links() ?>
    </body>
</html>