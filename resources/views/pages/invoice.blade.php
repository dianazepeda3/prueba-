@extends('../layout/' . $layout)

@section('subhead')
    <title>Invoice - Rocketman - Tailwind HTML Admin Template</title>
@endsection

@section('subcontent')
    <div class="intro-y flex flex-col sm:flex-row items-center mt-8">
        <h2 class="text-lg font-medium mr-auto">Invoice</h2>
        <div class="w-full sm:w-auto flex mt-4 sm:mt-0">
            <button class="btn btn-primary shadow-md mr-2">
                <i class="w-4 h-4 mr-2" data-lucide="printer"></i> Print Invoice
            </button>
            <button class="btn box">
                <i class="w-4 h-4 mr-2" data-lucide="settings"></i> Settings
            </button>
        </div>
    </div>
    <div class="box mt-5">
        <div class="flex flex-col lg:flex-row pt-10 px-5 sm:px-20 sm:pt-20 lg:pb-20 text-center sm:text-left">
            <div class="font-semibold text-primary text-3xl">INVOICE</div>
            <div class="mt-20 lg:mt-0 lg:ml-auto lg:text-right">
                <div class="text-xl text-primary font-medium">INV-1923195</div>
                <div class="mt-1">Due date: Mar 26, 2022</div>
            </div>
        </div>
        <div class="flex flex-col lg:flex-row px-5 sm:px-20 pt-10 pb-10 sm:pb-20">
            <div>
                <div class="text-base text-slate-500">From</div>
                <div class="text-lg font-medium text-primary mt-2">Left4code</div>
                <div class="mt-1">left4code@gmail.com</div>
                <div class="mt-1">8023 Amerige Street Harriman, NY 10926.</div>
            </div>
            <div class="lg:text-right mt-10 lg:mt-0 lg:ml-auto">
                <div class="text-base text-slate-500">Billed to</div>
                <div class="text-lg font-medium text-primary mt-2">Arnold Schwarzenegger</div>
                <div class="mt-1">arnodlschwarzenegger@gmail.com</div>
                <div class="mt-1">260 W. Storm Street New York, NY 10025.</div>
            </div>
        </div>
        <div class="px-5 sm:px-16 py-10 sm:py-20">
            <div class="overflow-x-auto">
                <table class="table">
                    <thead>
                        <tr>
                            <th class="border-b-2 dark:border-darkmode-400 whitespace-nowrap">DESCRIPTION</th>
                            <th class="border-b-2 dark:border-darkmode-400 text-right whitespace-nowrap">QTY</th>
                            <th class="border-b-2 dark:border-darkmode-400 text-right whitespace-nowrap">PRICE</th>
                            <th class="border-b-2 dark:border-darkmode-400 text-right whitespace-nowrap">SUBTOTAL</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="border-b dark:border-darkmode-400">
                                <div class="font-medium whitespace-nowrap">Rocketman Admin Template</div>
                                <div class="text-slate-500 text-sm mt-0.5 whitespace-nowrap">Regular License</div>
                            </td>
                            <td class="text-right border-b dark:border-darkmode-400 w-32">2</td>
                            <td class="text-right border-b dark:border-darkmode-400 w-32">$2,500.00</td>
                            <td class="text-right border-b dark:border-darkmode-400 w-32 font-medium">$5,000.00</td>
                        </tr>
                        <tr>
                            <td class="border-b dark:border-darkmode-400">
                                <div class="font-medium whitespace-nowrap">Vuejs Admin Template</div>
                                <div class="text-slate-500 text-sm mt-0.5 whitespace-nowrap">Regular License</div>
                            </td>
                            <td class="text-right border-b dark:border-darkmode-400 w-32">1</td>
                            <td class="text-right border-b dark:border-darkmode-400 w-32">$2,145.11</td>
                            <td class="text-right border-b dark:border-darkmode-400 w-32 font-medium">$2,145.11</td>
                        </tr>
                        <tr>
                            <td class="border-b dark:border-darkmode-400">
                                <div class="font-medium whitespace-nowrap">React Admin Template</div>
                                <div class="text-slate-500 text-sm mt-0.5 whitespace-nowrap">Regular License</div>
                            </td>
                            <td class="text-right border-b dark:border-darkmode-400 w-32">1</td>
                            <td class="text-right border-b dark:border-darkmode-400 w-32">$2,145.11</td>
                            <td class="text-right border-b dark:border-darkmode-400 w-32 font-medium">$2,145.11</td>
                        </tr>
                        <tr>
                            <td>
                                <div class="font-medium whitespace-nowrap">Laravel Admin Template</div>
                                <div class="text-slate-500 text-sm mt-0.5 whitespace-nowrap">Regular License</div>
                            </td>
                            <td class="text-right w-32">3</td>
                            <td class="text-right w-32">$2,145.11</td>
                            <td class="text-right w-32 font-medium">$6,435.33</td>
                        </tr>
                        <tr>
                            <td colspan="3" class="!pt-6 border-transparent dark:!border-transparent text-right font-medium w-32">TOTAL</td>
                            <td class="!pt-6 border-transparent dark:!border-transparent text-right font-medium w-32">$15,725.55</td>
                        </tr>
                        <tr>
                            <td colspan="3" class="border-transparent dark:!border-transparent text-right font-medium w-32">DISCOUNT</td>
                            <td class="border-transparent dark:!border-transparent text-right font-medium w-32">$725</td>
                        </tr>
                        <tr>
                            <td colspan="3" class="border-transparent dark:!border-transparent font-medium text-right w-32">GRAND TOTAL</td>
                            <td class="border-transparent dark:!border-transparent text-right w-32 font-medium">$15,000.55</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="mx-5 sm:mx-16 pb-16 pt-8 mt-20 border-t border-slate-200/60">
            Thanks for buying from <a href="" class="text-primary">Left4code</a> All amounts shown on this invoice are in US dollars.
        </div>
    </div>
@endsection
