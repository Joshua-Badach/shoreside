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
        <div class="form-set">
            <form action="" class="col-sm-12 form-1">

                <p>Standard form for every request (form 1)</p>

                <div class="form-group">
                    <label for="fName">First Name:</label><br>
                    <input type="text" class="form-control" id="fName" name="fName" placeholder="First Name" required><br><br>
                </div>

                <div class="form-group">
                    <label for="lName">Last Name:</label><br>
                    <input type="text" class="form-control" id="lName" name="lName" placeholder="Last Name" required><br><br>
                </div>

                <div class="form-group">
                    <label for="email">Email Address:</label><br>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Email Address" required><br><br>
                </div>

                <div class="form-group form-check">
                    <input type="checkbox" class="form-check-input" id="emailSignUp" name="emailSignUp" value="emailSignUp">
                    <label for="emailSignUp" class="form-check-label">  I would like to receive promotions and occasional emails from Recreational Power Sports.</label><br><br>
                </div>

                <div class="form-group">
                    <label for="phone">Phone Number:</label><br>
                    <input type="tel" class="form-control" id="phone" name="phone" placeholder="Phone Number" required><br>
                </div>

                <div class="form-group form-check">
                    <p>Can we text you at this number?</p>
                    <input type="radio" class="form-check-input" id="textYouYes" name="textYou" value="Yes">
                    <label for="textYouYes" class="form-check-label">Yes</label><br>
                    <input type="radio" class="form-check-input" id="textYouNo" name="textYou" value="No" checked>
                    <label for="textYouNo"class="form-check-label">No</label><br><br>
                </div>

                <p>On submit pull up specific request form</p>

                <button type="submit" class="btn btn-primary next">Next Step</button>
<!--            <input id="submitbtn" type="submit">-->
            </form>

            <form action="" class="col-sm-12 form-2" style="display:none">
                <div class="form-group form-check">
                    <p>Value unit form (form 2, if == on page || dropdown select)</p>
                    <label for="unit" class="form-check-label">Unit Type:</label><br>
                    <select name="unit" id="unit">
                        <option class="form-check-input" value="---">---</option>
                        <option class="form-check-input" value="marine">Marine</option>
                        <option class="form-check-input" value="atvUtv">ATV/UTV</option>
                        <option class="form-check-input" value="snowmobile">Snowmobile</option>
                        <option class="form-check-input" value="misc">Other</option>
                    </select><br><br>
                </div>
                <div class="form-group">
                    <label for="description">Tell us about your units</label><br>
                    <textarea type="textarea" class="form-control" id="description" name="description"></textarea><br><br>
                </div>
                <div class="form-group">
                    <label for="value">How much do you want for it?</label><br>
                    <input type="text" id="value" class="form-control" name="value"><br><br>
                </div>
                <p>Are you interested in trading you unit in towards the purchase of something else?</p>
                <input type="radio" id="textYouYes" name="textYou" value="Yes">
                <label for="textYou1">Yes</label><br>
                <input type="radio" id="textYouNo" name="textYou" value="No" checked>
                <label for="textYou2">No</label><br><br>
                <p>if yes return below</p>
                <label for="description">What are you looking for?</label><br>
                <textarea type="textarea" id="tradeinRequest" name="tradeinRequest"></textarea><br><br>

                <br><br>
                <button type="submit" class="btn btn-primary next">Next Step</button>
<!--                <input type="submit">-->
            </form>

        <form action="" class="col-sm-12 form-3">
            <p>Parts request form (form 3, if == on page || dropdown select)</p>

            <label for="description">What parts do you need?</label><br>
            <textarea type="textarea" id="description" name="description" placeholder="Do you gave a part number?"></textarea><br><br>
            <br><br>
            <button type="submit" class="btn btn-primary next">Next Step</button>
            <!--            <input type="submit">-->
        </form>

        <form action="" class="col-sm-12 form-4">
            <p>General request form (form 4, if == on page || dropdown select)</p>

            <label for="message">We would love to hear from you</label><br>
            <textarea type="textarea" id="message" name="message"></textarea><br><br>
            <br><br>
            <button type="submit" class="btn btn-primary next">Next Step</button>

            <!--            <input type="submit">-->
        </form>
        </div>
    </div>
</div>

<br><br>
<p>Jotform call href to specific page</p>
