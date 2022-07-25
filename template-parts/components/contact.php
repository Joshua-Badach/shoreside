<?php



?>
<section class="container contactSelection">
    <h3 class="contactHelp">How can we help?</h3>
    <p>Select form, return form 1 && ready form 2 based on selection</p>
    <div class="row justify-content-center contactRow">
        <section class="col-2">
            <a href="#" class="icon">
                <h3>Request Service</h3>
            </a>
        </section>
        <section class="col-2">
            <a href="#" class="icon">
                <h3>Request Parts</h3>
            </a>
        </section>
        <section class="col-2">
            <a href="#" class="icon">
                <h3>Value Unit</h3>
            </a>
        </section>
        <section class="col-2">
            <a href="/financing/" class="icon">
                <h3>Financing</h3>
            </a>
        </section>
        <section class="col-2">
            <a href="/general/" class="icon">
                <h3>General</h3>
            </a>
        </section>
    </div>
</section>
<div class="container detailsForm">
    <div class="row">
        <form action="" class="form-1 col-sm-12">
            <p>Standard form for every request (form 1)</p>
            <label for="fName">First Name:</label><br>
            <input type="text" id="fName" name="fName" placeholder="First Name" required><br><br>
            <label for="lName">Last Name:</label><br>
            <input type="text" id="lName" name="lName" placeholder="Last Name" required><br><br>
            <label for="email">Email Address:</label><br>
            <input type="email" id="email" name="email" placeholder="Email Address" required><br><br>
            <input type="checkbox" id="emailSignUp" name="emailSignUp" value="emailSignUp">
            <label for="emailSignUp">  I would like to receive promotions and occasional emails from Recreational Power Sports.</label><br><br>

            <label for="phone">Phone Number:</label><br>
            <input type="tel" id="phone" name="phone" placeholder="Phone Number" required><br>
            <p>Can we text you at this number?</p>
            <input type="radio" id="textYouYes" name="textYou" value="Yes">
            <label for="textYou1">Yes</label><br>
            <input type="radio" id="textYouNo" name="textYou" value="No" checked>
            <label for="textYou2">No</label><br><br>
            <p>On submit pull up specific request form</p>
            <input type="submit">
        </form>
    </div>
</div>
<div class="container">
    <div class="row">
        <form action="" class="form-2 col-sm-12">
            <p>Value unit form (form 2, if == on page || dropdown select)</p>

            <label for="unit">Unit Type:</label><br>
            <select name="unit" id="unit">
                <option value="---">---</option>
                <option value="marine">Marine</option>
                <option value="atvUtv">ATV/UTV</option>
                <option value="snowmobile">Snowmobile</option>
                <option value="misc">Other</option>
            </select><br><br>
            <label for="description">Tell us about your units</label><br>
            <textarea type="textarea" id="description" name="description"></textarea><br><br>

            <label for="value">How much do you want for it?</label><br>
            <input type="text" id="value" name="value"><br><br>

            <p>Are you interested in trading you unit in towards the purchase of something else?</p>
            <input type="radio" id="textYouYes" name="textYou" value="Yes">
            <label for="textYou1">Yes</label><br>
            <input type="radio" id="textYouNo" name="textYou" value="No" checked>
            <label for="textYou2">No</label><br><br>
            <p>if yes return below</p>
            <label for="description">What are you looking for?</label><br>
            <textarea type="textarea" id="tradeinRequest" name="tradeinRequest"></textarea><br><br>

            <br><br>
            <input type="submit">
        </form>
    </div>
</div>

<div class="container">
    <div class="row">
        <form action="" class="form-2 col-sm-12">
            <p>Parts request form (form 2, if == on page || dropdown select)</p>

            <label for="description">What parts do you need?</label><br>
            <textarea type="textarea" id="description" name="description" placeholder="Do you gave a part number?"></textarea><br><br>
            <br><br>
            <input type="submit">
        </form>
    </div>
</div>


<div class="container">
    <div class="row">
        <form action="" class="form-2 col-sm-12">
            <p>General request form (form 2, if == on page || dropdown select)</p>

            <label for="message">We would love to hear from you</label><br>
            <textarea type="textarea" id="message" name="message"></textarea><br><br>
            <br><br>
            <input type="submit">
        </form>
    </div>
</div>

<br><br>
<p>Jotform call href to specific page</p>