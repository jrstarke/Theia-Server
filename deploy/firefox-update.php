<?php 
$version = "1.1.1";
$minFirefoxVersion = "3.0";
$maxFirefoxVersion = "8.*";
$location = "https://keg.cs.uvic.ca/collector/chisel/LoggerFirefox.xpi";
$description = "https://keg.cs.uvic.ca/collector/chisel/firefox-changes.xhtml";

header("Content-type: text/xml");

echo "<?xml version='1.0' encoding='UTF-8'?>"; ?>

<RDF:RDF xmlns:RDF="http://www.w3.org/1999/02/22-rdf-syntax-ns#"
         xmlns:em="http://www.mozilla.org/2004/em-rdf#">

  <!-- This Description resource includes all the update and compatibility information for
       a single add-on with the id foobar@developer.mozilla.org. You can list multiple
       add-ons information in the same RDF file. -->
  <RDF:Description about="urn:mozilla:extension:theia@github.com">
    <em:updates>
      <RDF:Seq>

        <!-- Each li is a different version of the same add-on -->
        <RDF:li>
          <RDF:Description>
            <em:version><?php echo $version ?></em:version> <!-- This is the version number of the add-on -->

            <!-- One targetApplication for each application the add-on is compatible with -->
            <em:targetApplication>
              <RDF:Description>
                <em:id>{ec8030f7-c20a-464f-9b0e-13a3a9e97384}</em:id>
                <em:minVersion><?php echo $minFirefoxVersion ?></em:minVersion>
                <em:maxVersion><?php echo $maxFirefoxVersion ?></em:maxVersion>

                <!-- This is where this version of the add-on will be downloaded from -->
                <em:updateLink><?php echo $location ?></em:updateLink>

                <!-- A page describing what is new in this updated version -->
                <em:updateInfoURL><?php echo $description ?></em:updateInfoURL>
              </RDF:Description>
            </em:targetApplication>
          </RDF:Description>
        </RDF:li>

      </RDF:Seq>
    </em:updates>

    <!-- A signature is only necessary if your add-on includes an updateKey
         in its install.rdf. -->
    <em:signature>MIGTMA0GCSqGSIb3DQEBBQUAA4GBAMO1O2gwSCCth1GwYMgscfaNakpN40PJfOWt
                  ub2HVdg8+OXMciF8d/9eVWm8eH/IxuxyZlmRZTs3O5tv9eWAY5uBCtqDf1WgTsGk
                  jrgZow1fITkZI7w0//C8eKdMLAtGueGfNs2IlTd5P/0KH/hf1rPc1wUqEqKCd4+L
                  BcVq13ad</em:signature>
  </RDF:Description>
</RDF:RDF>