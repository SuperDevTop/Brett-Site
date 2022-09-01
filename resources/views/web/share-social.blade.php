<!DOCTYPE html>
<html>
<head>
    <title>How to Add Share Social Media Button in Laravel - NiceSnippets.com</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.min.js" integrity="sha512-XKa9Hemdy1Ui3KSGgJdgMyYlUg1gM+QhL6cnlyTe2qzMCYm4nAZ1PsVerQzTTXzonUR+dmswHqgJPuwCq1MaAg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/css/bootstrap.min.css" integrity="sha512-P5MgMn1jBN01asBgU0z60Qk4QxiXo86+wlFahKrsQf37c9cro517WzVSPPV1tDKzhku2iJ2FVgL67wG03SGnNA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style type="text/css">
        li{
            list-style: none;
            background: #e2e2e2;
            margin-left: 5px;
            text-align: center;
            border-radius:5px;
        }
        li span{
            font-size: 20px;
        }
        ul li{
            display: inline-block;
            padding: 10px 10px 5px;
        }
        #social-links{
            float: left;
        }
    </style>
</head>
<body>
    <div class="row mt-5">
        <div class="col-md-6 offset-3">
            <div class="card">
                <div class="card-header bg-info text-white">
                    <h5>How to Add Share Social Media Button in Laravel - NiceSnippets.com</h5>
                </div>
                <div class="card-body">
                    <strong class="float-left pt-2">Social Media : </strong>
                    {!! $socialShare !!}
                </div>
            </div>
        </div>
    </div>
</body>
</html>
