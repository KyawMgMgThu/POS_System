@extends('layouts.admin')
@section('navtitle', 'Terms Of Service')
@section('content')
    <div class="content-page">
        <div id="faqAccordion" class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="iq-accordion career-style faq-style">
                        <div class="card iq-accordion-block">
                            <div class="active-faq clearfix" id="headingOne">
                                <div class="container-fluid">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <a role="contentinfo" class="accordion-title" data-toggle="collapse"
                                                data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                <span>Terms of Use</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-details collapse show" id="collapseOne" aria-labelledby="headingOne"
                                data-parent="#faqAccordion">
                                <p class="mb-0">Thank you for using KyawGyi Point of Sale System. These terms and
                                    conditions outline the rules and regulations for the use of the KyawGyi Point of Sale
                                    System website and services.</p>
                            </div>
                        </div>
                        <div class="card iq-accordion-block">
                            <div class="active-faq clearfix" id="headingTwo">
                                <div class="container-fluid">
                                    <div class="row">
                                        <div class="col-sm-12"><a role="contentinfo" class="accordion-title collapsed"
                                                data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false"
                                                aria-controls="collapseTwo"><span> Accounts
                                                </span> </a></div>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-details collapse" id="collapseTwo" aria-labelledby="headingTwo"
                                data-parent="#faqAccordion">
                                <p class="mb-0">
                                    You are responsible for all activities under your account.
                                    Maintain the confidentiality of your passwords.
                                    You are responsible for any actions performed using your account.
                                </p>
                            </div>
                        </div>
                        <div class="card iq-accordion-block ">
                            <div class="active-faq clearfix" id="headingThree">
                                <div class="container-fluid">
                                    <div class="row">
                                        <div class="col-sm-12"><a role="contentinfo" class="accordion-title collapsed"
                                                data-toggle="collapse" data-target="#collapseThree" aria-expanded="false"
                                                aria-controls="collapseThree"><span>Changes to Terms</span> </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-details collapse" id="collapseThree" aria-labelledby="headingThree"
                                data-parent="#faqAccordion">
                                <p class="mb-0">KyawGyi Point of Sale System reserves the right to revise these terms at
                                    any time. Any changes will be posted on the website.
                                </p>
                            </div>
                        </div>
                        <div class="card iq-accordion-block ">
                            <div class="active-faq clearfix" id="headingThree">
                                <div class="container-fluid">
                                    <div class="row">
                                        <div class="col-sm-12"><a role="contentinfo" class="accordion-title collapsed"
                                                data-toggle="collapse" data-target="#collapseThree" aria-expanded="false"
                                                aria-controls="collapseThree"><span>Contact Us</span> </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-details collapse" id="collapseThree" aria-labelledby="headingThree"
                                data-parent="#faqAccordion">
                                <p class="mb-0">If you have any questions about these terms, please contact us through the
                                    Contact Us page. <a
                                        href="https://www.facebook.com/profile.php?id=100057101206481&mibextid=ZbWKwL"
                                        class="text-decoration-none">Facebook</a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
