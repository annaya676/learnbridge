</body>
</html>
<!DOCTYPE html>
<html>
<head>
    <title>LearnBridge</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<style>
    h2{
        color: #87409d; margin: 0 0 15px;
    }
    p{
        line-height: 1.5; margin: 0 0 15px;
    }
</style>
</head>
<body style="margin: 0; padding: 0; font-family: Arial, sans-serif; background-color: #f4f4f4; color: #333;">

    <!-- Container -->
    <div style="max-width: 600px; margin: 0 auto; background-color: #ffffff; overflow: hidden;">
        
        <!-- Header -->
        <div style=" text-align: center;">
            <img src="{{ asset('public/assets/images/email-banner.png') }}" alt="Image" style="   width: 100%;  ">
        </div>

        <!-- Main Content -->
        <div style="padding: 20px;">
          
            
            {!! $body !!}
          
            <br/>
            <br/>
         

           <p>Regards,<br/> LearnBridge<br/>Evalueserve University</p>

            <!-- CTA Button -->
            {{-- <div style="text-align: center; margin: 20px 0;">
                <a href="https://example.com" style="background-color: #87409d; color: #ffffff; padding: 10px 20px; text-decoration: none; border-radius: 5px; display: inline-block;">
                    Learn More
                </a>
            </div> --}}
        </div>

        <!-- Footer -->
        <div style="background-color: #eeeeee; padding: 15px; text-align: center; color: #777777; font-size: 12px;">
            {{-- <p style="margin: 0;">1234 Street, City, Country</p>
            <p style="margin: 5px 0;"><a href="#" style="color: #87409d; text-decoration: none;">Unsubscribe</a> | <a href="#" style="color: #87409d; text-decoration: none;">Privacy Policy</a></p> --}}
            <p style="margin: 0;">&copy; 2024 Company Name. All rights reserved.</p>
        </div>

    </div>

</body>
</html>
