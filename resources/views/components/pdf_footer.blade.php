<style>
    footer {
        position: fixed;
        bottom: 0px;
        left: 0;
        right: 0;
        width: 100%;
        margin: 10px;

        /* or adjust as needed */
        padding-top: 10px;

        /* background-color: #849e8c; */
        color: black;

        font-size: 10px;
        font-weight: bold;
        text-align: center;

        border-top: 2px solid #1a4e9c;
    }
</style>
<footer>
    {{ strtoupper($company->Address) }} | TEL:
    {{ $company->Contact }}
</footer>
