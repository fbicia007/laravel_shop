@extends('master')

@section('title','category')

@section('categoryMenu')
    @foreach($categories as $category)
        <a class="dropdown-item" href="{{$category->id}}">{{$category->name}}</a>
    @endforeach
@endsection

@section('footerList')
    @foreach($categories as $category)
        <li><a class="text-muted" href="{{$category->id}}">{{$category->name}}</a></li>
    @endforeach
@endsection

@section('content')

    <main role="main">
        <div class="container">
            <span><a href="/" class="text-dark">Home</a> / Privacy Policy</span>
        </div>
        <div class="album py-5 bg-light">
            <div class="container" style="margin-top: -48px;">


                <div class=WordSection1 style='layout-grid:15.6pt'>

                    <p class=MsoNormal><a name="OLE_LINK1"></a><a name="OLE_LINK2"><span
                                style='mso-bookmark:OLE_LINK1'><span lang=EN-US style='mso-bidi-font-size:10.5pt;
font-family:Helvetica;mso-bidi-font-family:Helvetica;color:#333333;background:
white'>Mmozone&nbsp;respect your privacy rights and recognise the importance of
protecting the Personal Information (as defined below) provided by you to us.
This Privacy Policy describes how Mmozone collects, stores, and uses the
Personal Information you provide to us through Mmozone web sites and through
telephone or e-mail communications you may have with us. This Privacy Policy
also describes the choices available to you regarding Mmozone use of the
Personal Information you provide to us, and the actions you can take to access
this information and request that Mmozone correct or delete it appropriately.<o:p></o:p></span></span></a></p>

                    <p class=MsoNormal><span style='mso-bookmark:OLE_LINK2'><span style='mso-bookmark:
OLE_LINK1'><span lang=EN-US style='mso-bidi-font-size:10.5pt;font-family:Helvetica;
mso-bidi-font-family:Helvetica;color:#333333'><br>
<span style='background:white'>Consent</span><br>
<span style='background:white'>By using Mmozone websites, you acknowledged that
you have read this Privacy Policy and you consent to the practices described
herein with respect to Mmozone collection, use and disclosure the Personal Information
provided by you to us. This is Mmozone entire and exclusive Privacy Policy and
it supersedes any earlier version. We reserves the right to change this Privacy
Policy in accordance with the terms herein at any time, which is why we
encourage you to visit this page often, review this Privacy Policy frequently,
and remain informed about any changes to it.</span><br>
<span style='background:white'>Information Collection and Use Personal
Information Personal Information means information that can identify you as a
specific individual, such as your name, address, phone number, e-mail address,
or other contact information, whether at work or at home.</span><br>
<span style='background:white'>On all Company web sites that collect Personal
Information, we specifically describe what information is required in order to
provide you with the product, service, or features you have requested. We
collect Personal Information when you contact us, when you register with us,
when you use our products and services, when you submit an order with us, when
you visit our web sites or the web sites of certain of Mmozone partners, and
when you enter promotions and sweepstakes.<o:p></o:p></span></span></span></span></p>

                    <p class=MsoNormal><span style='mso-bookmark:OLE_LINK2'><span style='mso-bookmark:
OLE_LINK1'><span lang=EN-US style='mso-bidi-font-size:10.5pt;font-family:Helvetica;
mso-bidi-font-family:Helvetica;color:#333333'><br>
<span style='background:white'>Registration</span><br>
<span style='background:white'>When you register with us on Mmozone, you first
complete the on-line registration form, which requires you to create a username
and password. During registration, you are also required to provide Personal
Information, which may include name, billing address, shipping address,
telephone number, e-mail address, credit card number, and credit card
expiration date. We use this information so that we may contact you about the services
and products on the site(s) in which you have expressed interest or requested
and to facilitate the completion of an order.<o:p></o:p></span></span></span></span></p>

                    <p class=MsoNormal><span style='mso-bookmark:OLE_LINK2'><span style='mso-bookmark:
OLE_LINK1'><span lang=EN-US style='mso-bidi-font-size:10.5pt;font-family:Helvetica;
mso-bidi-font-family:Helvetica;color:#333333'><br>
<span style='background:white'>Promotions, Contests and Sweepstakes</span><br>
<span style='background:white'>From time-to-time, Mmozone may provide you the
opportunity to participate in promotions, contests or sweepstakes on its web
site(s). Such promotions, contests and sweepstakes will also be governed by the
rules and regulations posted with such promotions, contests and sweepstakes. If
you participate, you will be required to register with Mmozone, which will
require you to provide certain Personal Information. Participation in these
promotions, contests and sweepstakes is completely voluntary and you therefore
have a choice whether or not to register and provide your Personal Information.
The requested information typically includes contact information, such as name,
shipping address, e-mail address, and telephone number. We will use this
information to notify winners and award prizes. Additionally, during your
registration process you may opt-in to receiving additional related
communications from us. If you decide to opt-in, we will use the information
provided to send you communications described throughout this Privacy Policy.<o:p></o:p></span></span></span></span></p>

                    <p class=MsoNormal><span style='mso-bookmark:OLE_LINK2'><span style='mso-bookmark:
OLE_LINK1'><span lang=EN-US style='mso-bidi-font-size:10.5pt;font-family:Helvetica;
mso-bidi-font-family:Helvetica;color:#333333'><br>
<span style='background:white'>Other Information Collected</span><br>
<span style='background:white'>Some information may be collected automatically
every time you visit Mmozone web sites, such as cookies and computer
information. In addition, information may be collected from other independent,
third-party sources. We also collect information about which pages you visit
within Mmozone. Mmozone visitation data is identified only by a unique URL.<o:p></o:p></span></span></span></span></p>

                    <p class=MsoNormal><span style='mso-bookmark:OLE_LINK2'><span style='mso-bookmark:
OLE_LINK1'><span lang=EN-US style='mso-bidi-font-size:10.5pt;font-family:Helvetica;
mso-bidi-font-family:Helvetica;color:#333333'><br>
<span style='background:white'>Cookies</span><br>
<span style='background:white'>Mmozone uses both session ID cookies and
persistent cookies as part of its interaction with your browser. A cookie is an
alphanumeric identifier (a file) that Mmozone web sites transfer to your
computer's hard drive through a web browser to enable its systems to recognize
your browser for record-keeping purposes. A session ID cookie expires when you
close your browser, while a persistent cookie remains on your hard drive for an
extended period of time.</span><br>
<span style='background:white'>We use session ID cookies to make it easier for
you to navigate Mmozone. We use persistent cookies to identify and track which
sections of its web site you most often visit. We also use persistent cookies
in areas of its web site where you must register, and where you are able to
customize the information you see, so that you don't have to enter your
preferences more than once.</span><br>
<span style='background:white'>By configuring the options in your browser, you
may control how cookies are processed by your system. However, if you decline
the use of cookies you may not be able to use certain features on Mmozone and
you may be required to re-enter the information required to complete an order
during new or interrupted browser sessions.</span><br>
<span style='background:white'>Some of Mmozone business partners (e.g.,
advertisers) use cookies on the site. We have no access or control over these
cookies (see &quot;Third Party Advertising&quot; and &quot;Third Party
Cookies&quot; below). Accordingly, this Privacy Policy covers the use of
cookies by Mmozone only and does not cover the use of cookies by any
advertisers.<o:p></o:p></span></span></span></span></p>

                    <p class=MsoNormal><span style='mso-bookmark:OLE_LINK2'><span style='mso-bookmark:
OLE_LINK1'><span lang=EN-US style='mso-bidi-font-size:10.5pt;font-family:Helvetica;
mso-bidi-font-family:Helvetica;color:#333333'><br>
<span style='background:white'>Log Files</span><br>
<span style='background:white'>As is true of most web sites, Mmozone gathers
certain information automatically and stores it in log files. This information
includes internet protocol (IP) addresses, browser type, internet services
provider (ISP), referring/exit pages, operating system, date / time stamp, and
click stream data. Mmozone uses this information to analyze trends, to screen
for fraud, to administer Mmozone sites, to track users' movements around the
web sites and to gather demographic information about Mmozone user base as a
whole.</span><br style='mso-special-character:line-break'>
<![if !supportLineBreakNewLine]><br style='mso-special-character:line-break'>
<![endif]><span style='background:white'><o:p></o:p></span></span></span></span></p>

                    <p class=MsoNormal><span style='mso-bookmark:OLE_LINK2'><span style='mso-bookmark:
OLE_LINK1'><span lang=EN-US style='mso-bidi-font-size:10.5pt;font-family:Helvetica;
mso-bidi-font-family:Helvetica;color:#333333;background:white'>Information from
Third Party Sources</span></span></span><span style='mso-bookmark:OLE_LINK2'><span
                                style='mso-bookmark:OLE_LINK1'><span lang=EN-US style='mso-bidi-font-size:10.5pt;
font-family:Helvetica;mso-bidi-font-family:Helvetica;color:#333333'><br>
<span style='background:white'>To improve services and enhance personalization,
Mmozone may periodically obtain information about you from other independent
third party sources and add it to our account information. For example, when
you visit a site on which Mmozone advertises, and click through such
advertisement, Mmozone may place cookies on your computer.<o:p></o:p></span></span></span></span></p>

                    <p class=MsoNormal><span style='mso-bookmark:OLE_LINK2'><span style='mso-bookmark:
OLE_LINK1'><span lang=EN-US style='mso-bidi-font-size:10.5pt;font-family:Helvetica;
mso-bidi-font-family:Helvetica;color:#333333'><br>
<span style='background:white'>Third Party Advertising</span><br>
<span style='background:white'>The ads that appear from time to time on Mmozone
web sites are delivered to you by a third party. Information about your visits
to the sites, such as number of times you have viewed an ad (but not your name,
address or other Personal Information), is used to serve ads to you.<o:p></o:p></span></span></span></span></p>

                    <p class=MsoNormal><span style='mso-bookmark:OLE_LINK2'><span style='mso-bookmark:
OLE_LINK1'><span lang=EN-US style='mso-bidi-font-size:10.5pt;font-family:Helvetica;
mso-bidi-font-family:Helvetica;color:#333333'><br>
<span style='background:white'>Use of Information</span><br>
<span style='background:white'>Verification, Billing, and Order Status</span><br>
<span style='background:white'>Mmozone collects Personal Information to verify
the accuracy of your name, billing address, shipping address, credit card
number, and credit card expiration date provided, to screen for fraud, to bill
you for products and services purchased and to pay you for products and
services sold. Mmozone uses your e-mail address to contact you regarding the
status of your order when necessary and to send you a Receipt Purchase/Sale
Confirmation and Order Shipping Notification.<o:p></o:p></span></span></span></span></p>

                    <p class=MsoNormal><span style='mso-bookmark:OLE_LINK2'><span style='mso-bookmark:
OLE_LINK1'><span lang=EN-US style='mso-bidi-font-size:10.5pt;font-family:Helvetica;
mso-bidi-font-family:Helvetica;color:#333333'><br>
<span style='background:white'>Special Offers and Updates</span><br>
<span style='background:white'>Mmozone collects information about which
sections of its web site you visit most often, so that it can send you our
newsletter and information about relevant offers, promotions, contests, and
sweepstakes which may interest you. Accordingly, Mmozone will occasionally send
you information on products, services, special deals, promotions and
sweepstakes.<o:p></o:p></span></span></span></span></p>

                    <p class=MsoNormal><span style='mso-bookmark:OLE_LINK2'><span style='mso-bookmark:
OLE_LINK1'><span lang=EN-US style='mso-bidi-font-size:10.5pt;font-family:Helvetica;
mso-bidi-font-family:Helvetica;color:#333333'><br>
<span style='background:white'>Service-related Announcements</span><br>
<span style='background:white'>Mmozone may, but is not obligated, to send you
strictly service-related announcements or rare occasions when it is necessary
to do so. For example, if our service is temporarily suspended for maintenance,
we might send you an e-mail.</span><br>
<span style='background:white'>Generally, you may not opt-out of these
communications since they are not promotional in nature. If you do not wish to
receive them, you may have the option to deactivate your account.<o:p></o:p></span></span></span></span></p>

                    <p class=MsoNormal><span style='mso-bookmark:OLE_LINK2'><span style='mso-bookmark:
OLE_LINK1'><span lang=EN-US style='mso-bidi-font-size:10.5pt;font-family:Helvetica;
mso-bidi-font-family:Helvetica;color:#333333'><br>
<span style='background:white'>Research</span><br>
<span style='background:white'>We also collect information for research
purposes and to provide anonymous reporting for internal and external clients. Mmozone
uses the information collected for its own internal marketing and demographic
studies to improve customer service and product offerings.<o:p></o:p></span></span></span></span></p>

                    <p class=MsoNormal><span style='mso-bookmark:OLE_LINK2'><span style='mso-bookmark:
OLE_LINK1'><span lang=EN-US style='mso-bidi-font-size:10.5pt;font-family:Helvetica;
mso-bidi-font-family:Helvetica;color:#333333'><br>
<span style='background:white'>Customer Service</span><br>
<span style='background:white'>We will communicate with you in response to your
inquiries, to provide the products and services you request, and to manage your
account. We will communicate with you by e-mail, live chat or telephone, in
accordance with your wishes.<o:p></o:p></span></span></span></span></p>

                    <p class=MsoNormal><span style='mso-bookmark:OLE_LINK2'><span style='mso-bookmark:
OLE_LINK1'><span lang=EN-US style='mso-bidi-font-size:10.5pt;font-family:Helvetica;
mso-bidi-font-family:Helvetica;color:#333333'><br>
<span style='background:white'>Preferences</span><br>
<span style='background:white'>Mmozone stores information that it collects
through cookies, log files, and third party sources to create a profile of your
preferences, in order to improve the content of Mmozone web site for you.<o:p></o:p></span></span></span></span></p>

                    <p class=MsoNormal><span style='mso-bookmark:OLE_LINK2'><span style='mso-bookmark:
OLE_LINK1'><span lang=EN-US style='mso-bidi-font-size:10.5pt;font-family:Helvetica;
mso-bidi-font-family:Helvetica;color:#333333'><br>
<span style='background:white'>Information Sharing and Disclosure</span><br>
<span style='background:white'>Mmozone does not sell or rent any of the
information collected to third parties for any purposes, but it shares
information with third parties as described below.<o:p></o:p></span></span></span></span></p>

                    <p class=MsoNormal><span style='mso-bookmark:OLE_LINK2'><span style='mso-bookmark:
OLE_LINK1'><span lang=EN-US style='mso-bidi-font-size:10.5pt;font-family:Helvetica;
mso-bidi-font-family:Helvetica;color:#333333'><br>
<span style='background:white'>Service Providers</span><br>
<span style='background:white'>Mmozone discloses the information collected to
external service providers necessary to facilitate the following outsourced
operations: address verification, credit card processing, fraud screening and
order shipping.<o:p></o:p></span></span></span></span></p>

                    <p class=MsoNormal><span style='mso-bookmark:OLE_LINK2'><span style='mso-bookmark:
OLE_LINK1'><span lang=EN-US style='mso-bidi-font-size:10.5pt;font-family:Helvetica;
mso-bidi-font-family:Helvetica;color:#333333'><br>
<span style='background:white'>Other Third Parties</span><br>
<span style='background:white'>Mmozone shares information, including Personal
Information, with trusted third-party partners so that customers can receive
information about third-party offers and promotions that may interest them.
These third-party partners do not have independent rights to share the
information provided to them by us.<o:p></o:p></span></span></span></span></p>

                    <p class=MsoNormal><span style='mso-bookmark:OLE_LINK2'><span style='mso-bookmark:
OLE_LINK1'><span lang=EN-US style='mso-bidi-font-size:10.5pt;font-family:Helvetica;
mso-bidi-font-family:Helvetica;color:#333333'><br>
<span style='background:white'>Compliance with Legal Authorities</span><br>
<span style='background:white'>As required by law, and to enforce customers or Mmozone
legal rights, and to comply with local, state, federal and international law, Mmozone
may disclose information to law enforcement agencies.<o:p></o:p></span></span></span></span></p>

                    <p class=MsoNormal><span style='mso-bookmark:OLE_LINK2'><span style='mso-bookmark:
OLE_LINK1'><span lang=EN-US style='mso-bidi-font-size:10.5pt;font-family:Helvetica;
mso-bidi-font-family:Helvetica;color:#333333'><br>
<span style='background:white'>Choice and Opt-Out</span><br>
<span style='background:white'>If you no longer wish to receive Mmozone
promotional communications, you may &quot;opt-out&quot; of receiving them by
following the instructions included in each communication or by e-mailing Mmozone
at customer&nbsp;service@www.Mmozone.<o:p></o:p></span></span></span></span></p>

                    <p class=MsoNormal><span style='mso-bookmark:OLE_LINK2'><span style='mso-bookmark:
OLE_LINK1'><span lang=EN-US style='mso-bidi-font-size:10.5pt;font-family:Helvetica;
mso-bidi-font-family:Helvetica;color:#333333'><br>
<span style='background:white'>Links to Other Web Sites</span><br>
<span style='background:white'>There are several places throughout Mmozone web
sites that may link you to other web sites that do not operate under this
Privacy Policy. When you click through to these web sites, this Privacy Policy
no longer applies. Mmozone recommends that you examine the privacy statements
for all third party web sites to understand their procedures for collecting,
using, and disclosing your Personal Information.<o:p></o:p></span></span></span></span></p>

                    <p class=MsoNormal><span style='mso-bookmark:OLE_LINK2'><span style='mso-bookmark:
OLE_LINK1'><span lang=EN-US style='mso-bidi-font-size:10.5pt;font-family:Helvetica;
mso-bidi-font-family:Helvetica;color:#333333'><br>
<span style='background:white'>Storage and Security of Personal Information
Storage</span><br>
<span style='background:white'>Mmozone stores the information it collects on
computers located in a controlled, secure facility protected from physical or
electronic unauthorized access, use, or disclosure.</span><br>
<span style='background:white'>Mmozone protects the privacy and integrity of
the information it collects by employing appropriate administrative protocols,
technical safeguards, and physical security controls designed to limit access,
detect and prevent the unauthorized access, improper disclosure, alteration, or
destruction of the information under its control. Mmozone transmits the
information used by its external service providers for the specific outsourced
operations listed above across public and private networks via recognized
encryption technologies, such as by using Secure Sockets Layer (SSL) software,
which encrypts the information you input.</span><br>
<span style='background:white'>Although Mmozone follows the procedures set
forth above to protect the Personal Information submitted to Mmozone, no method
of transmission over the Internet, or method of electronic storage, is 100%
secure. Thus, while Mmozone strives to use commercially acceptable means to
protect your Personal Information, Mmozone cannot guarantee its absolute
security.</span><br>
<span style='background:white'>If you have any questions about Mmozone
security, please feel free to send us an e-mail at&nbsp;sales@Mmozone.<o:p></o:p></span></span></span></span></p>

                    <p class=MsoNormal><span style='mso-bookmark:OLE_LINK2'><span style='mso-bookmark:
OLE_LINK1'><span lang=EN-US style='mso-bidi-font-size:10.5pt;font-family:Helvetica;
mso-bidi-font-family:Helvetica;color:#333333'><br>
<span style='background:white'>Internet Fraud</span><br>
<span style='background:white'>Mmozone has a ZERO TOLERANCE policy for Internet
fraud or any attempt to access or acquire customer or other information on its
web sites via illegal or surreptitious means. Mmozone works with local,
national, and international fraud investigation agencies and employs a variety
of electronic and other means to discourage, detect, and intercept fraudulent
activities. Mmozone aggressively prosecutes, to the fullest extent of the law,
those perpetrators apprehended conducting fraudulent activities on its web
site.</span><br>
<span style='background:white'>Agencies with which Mmozone cooperates are:
state and local police authorities, the United States Federal Bureau of
Investigation, US and International Customs Agencies, and Interpol.<o:p></o:p></span></span></span></span></p>

                    <p class=MsoNormal><span style='mso-bookmark:OLE_LINK2'><span style='mso-bookmark:
OLE_LINK1'><span lang=EN-US style='mso-bidi-font-size:10.5pt;font-family:Helvetica;
mso-bidi-font-family:Helvetica;color:#333333'><br>
<span style='background:white'>International Transfer</span><br>
<span style='background:white'>Personal Information collected by Mmozone may be
stored and processed in Canada or any other country in which Mmozone or its
affiliates, subsidiaries or agents maintain facilities, and by using Mmozone
web sites, you consent to any such transfer of Personal Information outside of
your country.<o:p></o:p></span></span></span></span></p>

                    <p class=MsoNormal><span style='mso-bookmark:OLE_LINK2'><span style='mso-bookmark:
OLE_LINK1'><span lang=EN-US style='mso-bidi-font-size:10.5pt;font-family:Helvetica;
mso-bidi-font-family:Helvetica;color:#333333'><br>
<span style='background:white'>Children</span><br>
<span style='background:white'>Mmozone sites are not intended for or directed
to persons under the age of 13. Mmozone does not buy or sell products or
services from or to children. Any person who provides their information to Mmozone
through Mmozone web sites represents to Mmozone that they are 13 years of age
or older.<o:p></o:p></span></span></span></span></p>

                    <p class=MsoNormal><span style='mso-bookmark:OLE_LINK2'><span style='mso-bookmark:
OLE_LINK1'><span lang=EN-US style='mso-bidi-font-size:10.5pt;font-family:Helvetica;
mso-bidi-font-family:Helvetica;color:#333333'><br>
<span style='background:white'>Changes to this Statement</span><br>
<span style='background:white'>Mmozone will from time-to-time update this
Privacy Policy, each time revising the last updated date at the top of the
Privacy Policy and indicate the nature of the revisions within the statement. Mmozone
will notify customers of material changes to this statement by e-mail or by
placing prominent notice on its website.</span></span></span></span><span
                            lang=EN-US style='mso-bidi-font-size:10.5pt;font-family:Helvetica;mso-bidi-font-family:
Helvetica;color:#333333;background:white'><o:p></o:p></span></p>

                </div>

            </div>
        </div>


    </main>

@endsection

@section('my-js')

@endsection
