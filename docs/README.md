# Documentation Index

The Page Experience Toolbox for PHP contains multiple different tools and libraries.

Click on one of the entries below to learn more about that sub-project:

* [**Page Experience Engine** - Higher-level library that aggregates and normalizes multiple tools to provide analysis and optimization functionality.](/docs/pxe/README.md#readme)
* [**PageSpeed Insights API** - API wrapper for PHP to run audits through the Google PageSpeed Insights API.](/docs/psi/README.md#readme)
* [**PX CLI tool** - `px` binary to run the above tooling through the console.](/docs/px/README.md#readme)

```mermaid
%%{init: {'theme': 'neutral'}}%%
graph
    subgraph PXT[PX Toolbox]

        PSI[<strong>PageSpeed Insights API Client</strong><br><br>API wrapper for PHP to run audits through<br>the Google PageSpeed Insights API]
        PXE[<strong>Page Experience Engine</strong><br><br>Higher-level library that aggregates and<br>normalizes multiple tools to provide<br>analysis and optimization functionality]
        PX[<strong>PX CLI Tool</strong><br><br>Console <code>px</code> binary to run the<br>PX Toolbox tools through the CLI]

        PX --provides CLI interface for--> PSI
        PX --provides CLI interface for--> PXE
        PSI --powers audits in--> PXE
    end

classDef package fill:#005af0,stroke:#002080,stroke-width:1px,color:#fff;
class PX,PXE,PSI package;

click PX "https://github.com/ampproject/px-toolbox-php/tree/main/docs/px/README.md" "Documentation for the PX CLI Tool"
click PSI "https://github.com/ampproject/px-toolbox-php/tree/main/docs/psi/README.md" "Documentation for the PageSpeed Insights API Client"
click PXE "https://github.com/ampproject/px-toolbox-php/tree/main/docs/pxe/README.md" "Documentation for the Page Experience Engine"
```
