<?php

namespace App\Http\Controllers;



class ConfigController extends Controller
{

    // IN THIS CONTROLLER YOU FOUND ALL DEFAULT VALUES, IF YOU MAKE CHANGES,
    // CHANGE IT HERE OR YOUR PROGRAM WILL NOT WORK!

    // Main

    public const SECUREPATHS = ['secure_dnt'];
    public const COMPANYNAME = "Sabine-Blindow Schule";
    public const COMPANYIMPRINT = "https://www.sabine-blindow-schulen.de/impressum/";
    public const COMPANYPOLICY = "https://www.sabine-blindow-schulen.de/service/datenschutz/";

    // AJAXResponse
    public const RESPONSETIME = 1000 * 4;

    // Ticket Status
    public const STATUSNEW = 1;
    public const STATUSINEDIT = 2;
    public const STATUSCLOSED = 3;
    public const STATUSARCHIVED = 4;

    // s
    public const DEFAULTGROUP = 2;
    public const TICKETGROUP = 1;
    public const TICKETUSER = 1;
    public const SUPERGROUPS = [1, 2];
    public const GROUPASSIGNEDTOTICKET = 'Die Gruppe ist noch einem Ticket zugewiesen!';


    // Archived
    public const DAYSUNTILARCHIVED = 30;
    public const DAYSUNTILDELETED = 180;


    //Imageupload
    public const LIMITUPLOADEDIMAGES = 3;
    public const IMAGESIZEFAQ = 3;
    public const IMAGESIZETICKET = 3;
    public const IMAGEPATHFAQ = 'images/faq';
    public const IMAGEPATHARCHIVE = 'images/archive';
    public const IMAGEPATHTICKET = 'images/ticket';
    public const IMAGEPATHPARTNERS = 'images/contactpartners';
    public const IMAGESIZEPARTNERS = 3;

    PUBLIC const ALLOWEDEXTENSIONS = [
        "image/jpg",
        "image/png",
        "image/jpeg",
        "image/webp",
        "application/pdf"
    ];


    // MESSAGES
    public const LOGINREQUIRED = 'Zum verwenden bitte Anmelden!';
    public const NOACCESS = 'Zugriff verweigert!';
    public const SERVERERROR = 'Server Fehler!';
    public const LOGOUTSUCCESS = 'Du hast dich erfolgreich abgemeldet!';

    public const TITLEALREADYEXIST = 'Der Titel ist schon vorhanden';

    // CATEGORY
    public const CATEGORYALREADYEXIST = 'Die Kategorie ist schon vorhanden!';
    public const CATEGORYDOESNTEXIST = 'Die Kategorie existiert nicht';
    public const CATEGORYNOTFOUND = 'Es konnte keine Kategorie gefunden werden!';
    public const CATEGORYCREATESUCCESS = 'Die Kategorie wurde erfolgreich!';
    public const CATEGORYCHANGED = 'Die Kategorie wurde erfolgreich aktualisiert!';
    public const CATEGORYDELETEDSUCCESS = 'Die Kategorie wurde erfolgreich gelöscht!';
    public const CATEGORYCANTDELETE = 'Die Kategorie kann nicht gelöscht werden, da noch Tickets mit der Kategorie existieren!';
    public const CATEGORYASSETCANTDELETE = 'Die Kategorie kann nicht gelöscht werden, da noch Gegenstände mit der Kategorie existieren!';

    // USER
    public const USERNOTFOUND = 'Der Benutzer konnte nicht gefunden werden!';
    public const ASSETREMOVEFROMUSER = 'Der Gegenstand wurde vom Benutzer entfernt!';
    public const SUPERUSERS = [1, 2];
    public const STORAGEUSER = 2;
    public const SUPERUSERCANTBEDELETED = "Dies ist ein Superaccount und kann nicht gelöscht werden!";
    public const USERRENTSASSET = "Dieser Benutzer leiht noch ein Gegenstand aus und kann nicht gelöscht werden!";
    public const USERNAMEEXIST = 'Der Benutzername ist schon vergeben!';

    // Login
    public const WRONGUSERNAMEORPASSWORD = 'Der Benutzername oder das Passwort ist falsch!';
    public const USERHASNOGROUPS = 'Der Benutzer hat keine Gruppen!';

    // TICKET
    public const MAXTICKETAMOUNTS = 5;
    public const TICKETNOTFOUND = 'Es konnte kein Ticket gefunden werden!';
    public const NOTICKETSEXIST = 'Aktuell sind keine Tickets vorhanden!';
    public const NOTICKETSCREATED = 'Es wurden noch keine Tickets erstellt!';
    public const MAXTICKETSREACHED = 'Die Maximale Anzahl an Tickets wurde erreicht!';
    public const TICKETCREATEDSUCCESS = 'Das Ticket wurde erfolgreich erstellt!';
    public const TICKETEDITSUCCESS = 'Das Ticket wurde erfolgreich aktualisiert!';
    public const TICKETDELETED = 'Das Ticket wurde gelöscht!';
    public const TICKETCLOSED = 'Das Ticket wurde geschlossen!';
    public const TICKETOPENED = 'Das Ticket wurde geöffnet!';
    public const TOOMANYIMAGES = 'Es können nur ' . self::LIMITUPLOADEDIMAGES . ' Bilder hochgeladen werden!';
    public const SUPERTICKETSTATUS = [1, 2, 3, 4];

    public const TICKETSTATUSCANTDELETE = 'Der Status kann nicht gelöscht werden, da Tickets mit dem Status existieren!';

    // FAQ
    public const FAQCREATEDSUCCESS = 'Der FAQ-Eintrag wurde erfolgreich erstellt!';
    public const FAQDELETESUCCESS = 'Der FAQ-Eintrag wurde erfolgreich entfernt!';
    public const FAQCATEGORYDELETESUCCESS = 'Die FAQ-Kategorie wurde erfolgreich entfernt!';
    public const FAQCATEGORYDELETEERROR = 'Die FAQ-Kategorie konnte nicht gelöscht werden, da noch Einträge mit der Kategorie vorhanden sind!';
    public const ARTICLEDOESNTEXIST = 'Der Artikel existiert nicht';
    public const FAQMAXIMAGE = 3;
    public const FAQEDITSUCCES = 'Die Kategorie wurde erfolgreich bearbeitet!';
    public const FAQNOTFOUND = 'Kein FAQ-Eintrag gefunden!';

    // GROUP
    public const GROUPNOTFOUND = 'Es konnte keine Gruppe gefunden werden!';
    public const GROUPALREADYEXIST = 'Die Gruppe ist schon vorhanden!';
    public const GROUPNAMEALREADYEXIST = 'Der Gruppenname ist schon vorhanden!';
    public const GROUPCREATESUCCESS = 'Die Gruppe wurde erfolgreich erstellt!';
    public const GROUPEDITSUCCESS = 'Die Gruppe wurde erfolgreich bearbeitet!';
    public const ISSUPERGROUP = 'Dies ist eine Supergruppe und kann nicht gelöscht werden!';
    public const NONREMOVABLEGROUPS = ['2'];

    // Rights

    // Asset Location
    public const ASSETLOCATIONALREADYEXIST = 'Der Ort ist schon vorhanden!';
    public const ASSETLOCATIONDOESNTEXIST = 'Der Ort existiert nicht';
    public const ASSETLOCATIONNOTFOUND = 'Kein Ort wurde gefunden!';
    public const ASSETLOCATIONCREATESUCCESS = 'Der Ort wurde erfolgreich erstellt!';
    public const ASSETLOCATIONDELETESUCCESS = 'Der Ort wurde erfolgreich gelöscht!';
    public const ASSETLOCATIONCHANGED = 'Der Ort wurde aktuallisiert!';
    public const ASSETLOCATIONCANTDELETE =  'Der Ort kann nicht gelöscht werden, da es in einem Gegenstand verwendet wird!';

    // Asset Department
    public const ASSETDEPARTMENTALREADYEXIST = 'Die Abteilung ist schon vorhanden!';
    public const ASSETDEPARTMENTDOESNTEXIST = 'Die Abteilung  existiert nicht';
    public const ASSETDEPARTMENTNOTFOUND = 'Keine Abteilung wurde gefunden!';
    public const ASSETDEPARTMENTCREATESUCCESS = 'Die Abteilung  wurde erfolgreich erstellt!';
    public const ASSETDEPARTMENTDELETESUCCESS = 'Die Abteilung  wurde erfolgreich gelöscht!';
    public const ASSETDEPARTMENTCHANGED = 'Die Abteilung  wurde aktuallisiert!';
    public const ASSETDEPARTMENTCANTDELETE =  'Die Abteilung  kann nicht gelöscht werden, da es in einem Gegenstand verwendet wird!';
    public const ASSETDEPARTMENTCOLORALREADYEXIST = 'Die Farbe existiert bereits';

    // Asset Status
    public const ASSETSTATUSALREADYEXIST = 'Der Status ist schon vorhanden!';
    public const ASSETSTATUSDOESNTEXIST = 'Der Status  existiert nicht';
    public const ASSETSTATUSNOTFOUND = 'Kein Status wurde gefunden!';
    public const ASSETSTATUSCREATESUCCESS = 'Der Status  wurde erfolgreich erstellt!';
    public const ASSETSTATUSDELETESUCCESS = 'Der Status  wurde erfolgreich gelöscht!';
    public const ASSETSTATUSCHANGED = 'Der Status  wurde aktuallisiert!';
    public const ASSETSTATUSCANTDELETE =  'Der Status  kann nicht gelöscht werden, da noch Gegenstände mit dem Status existieren!';
    public const ASSETSTATUSCOLORALREADYEXIST = 'Die Farbe existiert bereits';

    // Asset Model
    public const SUPERMODELS = [1];
    public const CUSTOMMODEL = 1;
    public  const MODELSUPERCANTDELETE = 'Das Modell kann nicht gelöscht oder bearbeitet werden!';
    public const MODELALREADYEXIST = 'Das Modell ist schon vorhanden!';
    public const MODELDOESNTEXIST = 'Das Modell existiert nicht';
    public const MODELNOTFOUND = 'Es konnte kein Modell gefunden werden!';
    public const MODELCREATESUCCESS = 'Das Modell wurde erfolgreich erstellt!';
    public const MODELCHANGED = 'Das Modell wurde erfolgreich aktualisiert!';
    public const MODELDELETEDSUCCESS = 'Das Modell wurde erfolgreich gelöscht!';
    public const MODELCANTDELETE = 'Das Modell kann nicht gelöscht werden!';
    public const MODELASSETCANTDELETE = 'Das Modell kann nicht gelöscht werden, da noch Gegenstände mit der Kategorie existieren!';

    // Asset Manufacturer
    public const MANUFACTURERALREADYEXIST = 'Der Hersteller ist schon vorhanden!';
    public const MANUFACTURERDOESNTEXIST = 'Der Hersteller existiert nicht';
    public const MANUFACTURERNOTFOUND = 'Es konnte kein Hersteller gefunden werden!';
    public const MANUFACTURERCREATESUCCESS = 'Der Hersteller wurde erfolgreich erstellt!';
    public const MANUFACTURERCHANGED = 'Der Hersteller wurde erfolgreich aktualisiert!';
    public const MANUFACTURERDELETEDSUCCESS = 'Der Hersteller wurde erfolgreich gelöscht!';
    public const MANUFACTURERCANTDELETE = 'Der Hersteller kann nicht gelöscht werden';
    public const MANUFACTURERASSETCANTDELETE = 'Der Hersteller kann nicht gelöscht werden, da noch Gegenstände mit dem Hersteller existieren!';

    // Archive
    public const NOARCHIVEDTICKETS = 'Aktuell sind keine Archivierten Tickets vorhanden!';

    //Lizenzen
    public const LICENSENOTFOUND = 'Die Lizenz wurde nicht gefunden!';
    public const LICENSECANTDELETE = 'Die Lizenz kann nicht gelöscht werden, da die Lizenz noch zu einem Gegenstand zugewiesen ist';
    public const LICENSEDOESNTEXIST = 'Die Lizenz existiert nicht';
    public const LICENSEDELETEDSUCCESS = 'Die Lizenz wurde erfolgreich gelöscht!';
    public const LICENSECREATESUCCESS = 'Die Lizenz wurde erfolgreich erstellt!';
    public const LICENSECHANGED = 'Die Lizenz wurde erfolgreich aktualisiert!';
    public const LICENSENOUSESLEFT = 'Die Lizenz kann nicht vergeben werden!';
    public const LICENSEASSIGNSUCCESS = 'Die Lizenz wurde dem Gerät erfolgreich zugewiesen';
    public const LICENSETOTALLESSTHANUSAGE = 'Die Anzahl der Lizenz kann nicht kleiner sein, als die Anzahl, wie oft die Lizenz vergeben wurde!';
    public const LICENSEREMOVEFROMASSET = 'Die Lizenz wurde vom Gegenstand entfernt';
    public const LICENSENOTIFICATIONDAYSBEFOREEXPIRED = 14;
    public const NOASSETSREMAINING = 'Die Lizenz ist an allen Gegenstände vergeben';

    //Assets
    public const ASSETNOTFOUND = 'Der Gegenstand wurde nicht gefunden!';
    public const ASSETCANTDELETE = 'Der Gegenstand kann nicht gelöscht werden, da die noch zu einer Person oder einer Lizenz zugewiesen ist';
    public const ASSETDOESNTEXIST = 'Der Gegenstand existiert nicht';
    public const ASSETDELETEDSUCCESS = 'Der Gegenstand wurde erfolgreich gelöscht!';
    public const ASSETCREATESUCCESS = 'Der Gegenstand wurde erfolgreich erstellt!';
    public const ASSETCHANGED = 'Der Gegenstand wurde erfolgreich aktualisiert!';
    public const ASSETASSIGNSUCCESS = 'Der Gegenstand wurde einer Person erfolgreich zugewiesen';
    public const ASSETIDALREADYUSED = 'Ein Gegenstand mit dieser ID existiert schon';
    public const ASSETMACALREADYUSED = 'Ein Gegenstand mit dieser Mac-Addresse existiert schon';
    public const ASSETSERIALALREADYUSED = 'Ein Gegenstand mit dieser Seriennummer existiert schon';
    public const ASSETORDERALREADYUSED = 'Ein Gegenstand mit dieser Bestellnummer existiert schon';
    public const ASSETCREATEBUTFAILEDTOASSIGN = 'Der Gegenstand wurde erstellt, aber es konnte keiner Person zugewiesen werden';
    public const ASSETCHANGEDBUTFAILEDTOASSIGN = 'Der Gegenstand wurde bearbeitet, aber es konnte keiner Person zugewiesen werden';
    public const ASSETNOTASSIGNEDTOPERSON = 'Der Gegenstand wurde keiner Person zugewiesen!';
    public const ASSETRENTEDTOPERSON = 'Der Gegenstand ist noch zu einer Person zugewiesen!';
    public const ASSETGOTLICENSE = 'Der Gegenstand hat noch mindestens eine Lizenz zugewiesen!';

    public const QRCODEERROR = 'Fehler beim generieren der QR-Codes';

    //Logs
    public const LOGSCREATE = 'erstellt';
    public const LOGSUPDATE = 'aktualisiert';
    public const LOGSDELETE = 'gelöscht';
    public const LOGSASSIGNASSET = 'Gegenstand zu einer Person zugewiesen';
    public const LOGSUNASSIGNASSET = 'Gegenstand zu Lager zugewiesen';
    public const LOGSMESSAGE = 'Ticketnachricht erstellt';
    public const LOGSARCHIVE = 'Ticket archiviert';
    public const LOGSLICENSEASSIGN = 'Lizenz zu einem Gegenstand zugewiesen';
    public const LOGSOPENTICKET = 'Das Ticket geöffnet';
    public const LOGSCLOSETICKET = 'Das Ticket geschlossen';
    public const LOGSUNTILDELETED = 14;

    //ContactPartners
    public const CONTACTPARTNERALREADYEXISTS = 'Ansprechpartner Existiert bereits';
    public const CONTACTPARTNERSUCCESS = 'Der Ansprechtpartner wurde erstellt!';
    public const CONTACTPARTNERDOESNTEXIST = 'Der Ansprechpartner existiert nicht';
    public const CONTACTPARTNERDELETESUCCESS = 'Der Ansprechpartner wurde gelöscht!';

}
